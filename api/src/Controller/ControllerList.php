<?php

class ControllerList
{
    public function __construct()
    {
        $this->dataBaseQuery = new DBGateway();
    }

    public function route($action)
    {
        $productTypeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($action) {
            case "listTypes":
                $this->dataBaseQuery->dataBaseQueryListTypes();
                break;

            case "listProductsByTypeId":
                $this->dataBaseQuery->dataBaseQueryListProductsByTypeID($productTypeId);
                break;

            default:
                echo("Error");
        }
    }
}
