<?php

class XmlImportService
{
    public function processXml($xmlFilePath, $mapping)
    {
        // Load the XML file
        $xml = simplexml_load_file($xmlFilePath);

        // Iterate through each product node in the XML file
        foreach ($xml->product as $productNode) {
            // Check if the product already exists in PrestaShop using the reference field from the mapping
            if (!$this->productExists((string) $productNode->{$mapping['reference']})) {
                // Create a new product if it doesn't exist
                $this->createProduct($productNode, $mapping);
            }
        }
    }

    private function productExists($reference)
    {
        // Check if a product with the given reference already exists in the database
        return Product::existsInDatabase((int) Product::getIdByReference($reference), 'product');
    }

    private function createProduct($productNode, $mapping)
    {
        // Create a new Product object
        $product = new Product();
        
        // Map the XML fields to PrestaShop fields and assign values to the Product object
        foreach ($mapping as $xmlField => $psField) {
            $product->{$psField} = (string) $productNode->{$xmlField};
        }
        
        // Save the new product in the database
        $product->add();
    }
}
