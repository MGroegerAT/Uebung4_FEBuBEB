<?php

class ControllerCart

{
    public function __construct()
    {
        $this->dataBaseQuery = new DBGateway();
        $this->cartList = new CartListService();
    }

    public function route($action)
    {
        $articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($action) {

            case "addArticle":
                $this->cartList->addProductToCart($articleId, $this->dataBaseQuery->dataBaseQueryallTypesByID());
                break;

            case "removeArticle":
                $this->cartList->removeProductFromCart($articleId, $this->dataBaseQuery->dataBaseQueryallTypesByID());
                break;

            case "listCart":
                $this->cartList->generateCartList();
                break;

            default:
                echo("Error");
        }
    }
}