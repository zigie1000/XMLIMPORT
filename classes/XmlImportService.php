<?php

class XmlImportService
{
    public function processXml($xmlFilePath, $mapping)
    {
        $xml = simplexml_load_file($xmlFilePath);
        foreach ($xml->product as $productNode) {
            if (!$this->productExists((string) $productNode->{$mapping['reference']})) {
                $this->createProduct($productNode, $mapping);
            }
        }
    }

    private function productExists($reference)
    {
        return Product::existsInDatabase((int) Product::getIdByReference($reference), 'product');
    }

    private function createProduct($productNode, $mapping)
    {
        $product = new Product();
        foreach ($mapping as $xmlField => $psField) {
            $product->{$psField} = (string) $productNode->{$xmlField};
        }
        $product->add();
    }
}
