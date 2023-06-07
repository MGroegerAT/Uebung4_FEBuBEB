<?php

// start session
//session_start();
class Controller
{

    public function __construct()
    {
        $this->dataBaseQuery = new DBGateway();
        $this->articleList = new mySession();
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
                $this->articleList->addArticle($articleId);
                break;

            case "removeArticle":
                $this->articleList->removeArticle($articleId);
                break;

            case "listCart":
                $this->articleList->showArticleList();
                break;

            default:
                echo("falsche Eingabe");
        }
    }
}
