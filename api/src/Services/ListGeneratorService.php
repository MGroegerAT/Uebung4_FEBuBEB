<?php

class ListGeneratorService
{
    // Generates Array and hand over the List to the JsonView

    public function __construct()
    {
        $this->productList = new ProductModel();
        $this->outputView = new JsonView();
    }

    // Create structure of List for Product Types
    public function createProductTypeList($fetchedData)
    {
        foreach ($fetchedData as $result) {
            // with ID
            // $this->productList->productList[] = ["id" => $result["id"], 'productType' => $result['name'], 'url' => "http://localhost/Uebung3/index.php?action=listProductsByTypeId&typeId=" . $result['id']];

            // without ID
            $this->productList->productList[] = ['productType' => $result['name'], 'url' => "http://localhost/Uebung4/api/index.php?action=listProductsByTypeId&typeId=" . $result['id']];
        }

        $this->createJsonView($this->productList->productList);
    }

    // Create structure of List for Product Types by ID
    //
    public function createProductListByID($fetchedData)
    {

        $this->outputList[] = ['productType' => $fetchedData[0]["productTypeName"]];

        foreach ($fetchedData as $result) {
            $this->productList->productList[] = ["id" => $result["id"], 'name' => $result['productName'], "price" => $result["productPrice"]];
        }
        $this->outputList[] = ["products" => $this->productList->productList];
        $this->outputList[] = ['url' => "http://localhost/Uebung4/api/index.php?action=listTypes"];

        $this->createJsonView($this->outputList);
    }

    //call JsonView and hand over the ready output array
    public function createJsonView($dataOutput)
    {
        $this->outputView->dataOutput($dataOutput);
    }


}