<?php

session_start();

class CartListService
{
    public function __construct()
    {
        $this->jsonView = new JsonView();
    }

    /********************************************************
     *          add Article
     *
     ********************************************************/

    public function addProductToCart($articleId, $productList)
    {
        $alreadyExists = false;

        // check if article is already in the cartlist,
        // yes: increase amount +1, set $alreadyExists to true
        // no: nothing happens
        foreach ($_SESSION["cartList"] as $key => $listItem) {
            if ($listItem["id"] == $articleId) {
                $alreadyExists = $this->increaseItemAmount($key, $listItem);
            }
        }
        // article not in cartList,
        // add article to the list and add amount parameter
        if ($alreadyExists == false) {
            $this->addItemToCart($articleId, $productList);
        }

        $this->isViableArticle($articleId, $productList);
    }

    private function increaseItemAmount($key, $listItem)
    {
        $listItem["amount"] += 1;
        $_SESSION["cartList"][$key] = $listItem;
        return true;
    }

    private function addItemToCart($articleId, $productList)
    {
        foreach ($productList as $product) {
            if ($articleId == $product["id"]) {
                $product["amount"] = 1;
                $_SESSION["cartList"][] = $product;
            }
        }
    }

    /********************************************************
     *          remove Article
     *
     ********************************************************/
    public function removeProductFromCart($articleId, $productList)
    {
        foreach ($_SESSION["cartList"] as $key => $listItem) {
            if ($articleId == $listItem["id"]) {
                $this->reduceItemAmount($key, $listItem);
            }
        }
        $this->isViableArticle($articleId, $productList);
    }

    private function reduceItemAmount($key, $listItem)
    {
        $listItem["amount"] -= 1;

        if ($listItem["amount"] == 0) {
            unset($_SESSION["cartList"][$key]);
        } else {
            $_SESSION["cartList"][$key] = $listItem;
        }
    }

    /********************************************************
     *          generate Output
     *
     ********************************************************/
    public function generateCartList()
    {
        $jsonOutput = ['cart' => $_SESSION["cartList"]];
        $this->jsonView->dataOutput($jsonOutput);
    }


    private function stateMessage($message)
    {
        $stateMessage = ["state" => $message];
        $this->jsonView->dataOutput($stateMessage);
    }

    /********************************************************
     *          is Viable Article
     *
     ********************************************************/

    private function isViableArticle($articleId, $productList)
    {
        $isViableArticle = false;

        foreach ($productList as $product) {
            if ($articleId == $product["id"]) {
                $this->stateMessage("OK");
                $isViableArticle = true;
            }
        }
        if ($isViableArticle == false) {
            $this->stateMessage("ERROR");
        }
    }


}
