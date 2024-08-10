class XmlImportService
{
    public function processXml($xmlFilePath, $mapping)
    {
        try {
            // Load the XML file
            if (!file_exists($xmlFilePath)) {
                throw new Exception("File not found: $xmlFilePath");
            }
            $xml = simplexml_load_file($xmlFilePath);

            if ($xml === false) {
                throw new Exception("Failed to load XML file.");
            }

            // Iterate through each product node in the XML file
            foreach ($xml->product as $productNode) {
                // Check if the product already exists in PrestaShop using the reference field from the mapping
                if (!$this->productExists((string) $productNode->{$mapping['reference']})) {
                    // Create a new product if it doesn't exist
                    $this->createProduct($productNode, $mapping);
                }
            }
        } catch (Exception $e) {
            // Log the error
            PrestaShopLogger::addLog("XML Import Error: " . $e->getMessage(), 3);
        }
    }

    private function productExists($reference)
    {
        // Check if a product with the given reference already exists in the database
        return Product::existsInDatabase((int) Product::getIdByReference($reference), 'product');
    }

    private function createProduct($productNode, $mapping)
    {
        try {
            // Create a new Product object
            $product = new Product();
            
            // Map the XML fields to PrestaShop fields and assign values to the Product object
            foreach ($mapping as $xmlField => $psField) {
                $product->{$psField} = (string) $productNode->{$xmlField};
            }
            
            // Validate the product before adding
            if (!$product->validateFields(false)) {
                throw new Exception("Validation failed for product reference: " . (string) $productNode->{$mapping['reference']});
            }
            
            // Save the new product in the database
            $product->add();
        } catch (Exception $e) {
            // Log the error during product creation
            PrestaShopLogger::addLog("Error creating product: " . $e->getMessage(), 3);
        }
    }
}
