<?php

class Controller
{

    public function __construct()
    {
        $this->dataBaseQuery = new DBGateway();
        $this->cartList = new CartListService();
            }

    // Route depending on User Input
    public function route()
    {
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_SPECIAL_CHARS);
        $productTypeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_SPECIAL_CHARS);

        // new action
        $articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_SPECIAL_CHARS);


        // cases enhanced
        switch ($action) {
            case "listTypes":
                $this->dataBaseQuery->dataBaseQueryListTypes();
                break;

            case "listProductsByTypeId":
               $this->dataBaseQuery->dataBaseQueryListProductsByTypeID($productTypeId);

                break;

            case "addArticle":
                $this->cartList->addProductToCart($articleId, $this->dataBaseQuery->dataBaseQueryallTypesByID());
                break;

            case "removeArticle":
                $this->cartList->removeProductFromCart($articleId);
                break;

            case "listCart":
                $this->cartList->generateCartList();
                break;

            default:
                echo("falsche Eingabe");
        }
    }
}
