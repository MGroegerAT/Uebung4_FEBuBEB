<?php

class Controller
{
    public function __construct()
    {
        $this->cartController = new ControllerCart();
        $this->listController = new ControllerList();
    }

    public function route()
    {
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_SPECIAL_CHARS);


        switch ($action) {
            case "listTypes":
            case "listProductsByTypeId":
                $this->listController->route($action);
                break;

            case "addArticle":
            case "removeArticle":
            case "listCart":
                $this->cartController->route($action);
                break;

            default:
                echo("Error, wrong: " .$action);
        }
    }

}