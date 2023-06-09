<?php


session_start();

class CartListService
{


    public function __construct()
    {
        $this->jsonView = new JsonView();
    }

    public function addProductToCart($articleId, $productList)
    {
        $alreadyExists = false;

        foreach ($_SESSION["cartList"] as $key => $listItem) {
            if ($listItem["id"] == $articleId) {
                $alreadyExists = $this->increaseItemAmount($key, $listItem);
            }
        }

        if ($alreadyExists == false) {
            $this->addItemToCart($articleId, $productList);
        }
    }


    public function removeProductFromCart($articleId)
    {
        foreach ($_SESSION["cartList"] as $key => $listItem) {
            if ($articleId == $listItem["id"]) {
                $this->reduceItemAmount($key, $listItem);
            }
        }
    }
    
    public function generateCartList() {
        $jsonOutput = ['cart' => $_SESSION["cartList"]];
        $this->jsonView->dataOutput($jsonOutput);
    }


    private function reduceItemAmount($key, $listItem) {
        $listItem["amount"] -= 1;

        if ($listItem["amount"] == 0) {
            unset($_SESSION["cartList"][$key]);
        } else {
            $_SESSION["cartList"][$key] = $listItem;
        }
    }

    private function increaseItemAmount($key, $listItem) {

        $listItem["amount"] += 1;
        $_SESSION["cartList"][$key] = $listItem;

        return true;
    }

    private function addItemToCart($articleId, $productList) {
        foreach ($productList as $product) {
            if ($articleId == $product["id"]) {
                $product["amount"] = 1;
                $_SESSION["cartList"][] = $product;
            }
        }
    }

}
