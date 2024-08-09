<?php

class XmlFeedHandler
{
    protected $xml;

    public function __construct($filePath)
    {
        if (file_exists($filePath)) {
            $this->xml = simplexml_load_file($filePath);
        } else {
            throw new Exception('File not found: ' . $filePath);
        }
    }

    public function validateXml()
    {
        // Example validation: Check if the root element is 'products'
        if ($this->xml->getName() != 'products') {
            throw new Exception('Invalid XML structure');
        }

        // Additional validation logic can be added here
    }

    public function processProducts()
    {
        $products = [];

        foreach ($this->xml->product as $productNode) {
            $product = $this->mapProduct($productNode);
            if ($product) {
                $products[] = $product;
            }
        }

        return $products;
    }

    protected function mapProduct($productNode)
    {
        $product = new Product();

        // Mapping XML nodes to PrestaShop product fields
        $product->name = [(int) Configuration::get('PS_LANG_DEFAULT') => (string) $productNode->name];
        $product->active = (int) $productNode->active;
        $product->id_category_default = $this->getCategoryId((string) $productNode->category);
        $product->price = (float) $productNode->price;
        $product->id_tax_rules_group = (int) $productNode->tax_rules_group;
        $product->wholesale_price = (float) $productNode->wholesale_price;
        $product->on_sale = (bool) $productNode->on_sale;
        $product->reduction_price = (float) $productNode->discount->price;
        $product->reduction_percent = (float) $productNode->discount->percent;
        $product->reduction_from = (string) $productNode->discount->from;
        $product->reduction_to = (string) $productNode->discount->to;
        $product->reference = (string) $productNode->reference;
        $product->id_supplier = $this->getSupplierId((string) $productNode->supplier);
        $product->id_manufacturer = $this->getManufacturerId((string) $productNode->manufacturer);
        $product->ean13 = (string) $productNode->ean13;
        $product->upc = (string) $productNode->upc;
        $product->ecotax = (float) $productNode->ecotax;
        $product->width = (float) $productNode->dimensions->width;
        $product->height = (float) $productNode->dimensions->height;
        $product->depth = (float) $productNode->dimensions->depth;
        $product->weight = (float) $productNode->weight;
        $product->quantity = (int) $productNode->quantity;
        $product->minimal_quantity = (int) $productNode->minimal_quantity;
        $product->additional_shipping_cost = (float) $productNode->additional_shipping_cost;
        $product->unity = (string) $productNode->unity;
        $product->unit_price_ratio = (float) $productNode->unit_price_ratio;
        $product->description_short = [(int) Configuration::get('PS_LANG_DEFAULT') => (string) $productNode->description_short];
        $product->description = [(int) Configuration::get('PS_LANG_DEFAULT') => (string) $productNode->description];
        $product->tags = $this->getTags((string) $productNode->tags);
        $product->meta_title = [(int) Configuration::get('PS_LANG_DEFAULT') => (string) $productNode->meta_title];
        $product->meta_description = [(int) Configuration::get('PS_LANG_DEFAULT') => (string) $productNode->meta_description];
        $product->meta_keywords = [(int) Configuration::get('PS_LANG_DEFAULT') => (string) $productNode->meta_keywords];
        $product->link_rewrite = [(int) Configuration::get('PS_LANG_DEFAULT') => Tools::link_rewrite((string) $productNode->name)];
        $product->available_for_order = (bool) $productNode->available_for_order;
        $product->show_price = (bool) $productNode->show_price;
        $product->visibility = (string) $productNode->visibility;
        $product->available_date = (string) $productNode->available_date;

        // Additional mappings can be added as necessary

        return $product;
    }

    protected function getCategoryId($categoryName)
    {
        // Retrieve category ID by name
        $category = Category::searchByName((int) Configuration::get('PS_LANG_DEFAULT'), $categoryName);
        if (!$category) {
            throw new Exception('Category not found: ' . $categoryName);
        }
        return (int) $category['id_category'];
    }

    protected function getSupplierId($supplierName)
    {
        // Retrieve supplier ID by name
        $supplier = Supplier::getIdByName($supplierName);
        if (!$supplier) {
            $supplier = new Supplier();
            $supplier->name = $supplierName;
            $supplier->add();
            $supplierId = (int) $supplier->id;
        } else {
            $supplierId = (int) $supplier;
        }
        return $supplierId;
    }

    protected function getManufacturerId($manufacturerName)
    {
        // Retrieve manufacturer ID by name
        $manufacturer = Manufacturer::getIdByName($manufacturerName);
        if (!$manufacturer) {
            $manufacturer = new Manufacturer();
            $manufacturer->name = $manufacturerName;
            $manufacturer->add();
            $manufacturerId = (int) $manufacturer->id;
        } else {
            $manufacturerId = (int) $manufacturer;
        }
        return $manufacturerId;
    }

    protected function getTags($tags)
    {
        // Convert tags string to array
        $tagsArray = explode(',', $tags);
        return $tagsArray;
    }

    public function saveProducts($products)
    {
        foreach ($products as $product) {
            try {
                if ($product->add()) {
                    StockAvailable::setQuantity($product->id, 0, $product->quantity);  // Set the product stock quantity
                }
            } catch (Exception $e) {
                // Handle any errors that occur during save
                throw new Exception('Error saving product: ' . $e->getMessage());
            }
        }
    }
}
?>
