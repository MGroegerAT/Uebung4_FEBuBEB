<?php


session_start();

class CartListService
{

    private $jsonView;

    public function __construct()
    {
        $this->jsonView = new JsonView();
    }

    public function addProductToCart($articleId, $productList)
    {
        foreach ($productList as $index =>$product) {
            if ($articleId == $product["id"]) {
                $_SESSION["cartList"][] = $product;
            }
        }
    }

    public function removeProductFromCart($articleId)
    {
        foreach ($_SESSION["cartList"] as $index => $listEntry) {
            if ($articleId == $listEntry["id"]) {
                unset($_SESSION["cartList"][$index]);
            }
        }
    }

    public function generateCartList()
    {
        $jsonOutput = ['cart' => $_SESSION["cartList"]];
        echo json_encode($jsonOutput, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);


        // TODO das funktioniert nicht ... warum auch immer??
        //$this->jsonView($jsonOutput);
    }

}
