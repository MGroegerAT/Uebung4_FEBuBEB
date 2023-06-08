<?php

class DBGateway
{
    // DB Connection with different Querys and afterward call the ListGeneratorService and
    // hand over retrieved Data

    public function __construct()
    {
        $this->listGenerator = new ListGeneratorService();
        $this->pdo = new PDO("mysql:host=localhost;dbname=FH_HU43;charset=utf8", "root", "");
    }

    // DB Query for List Types
    public function dataBaseQueryListTypes()
    {
        $dbQuery = "SELECT id, name from product_types ORDER BY id";
        $this->listGenerator->createProductTypeList($this->dataBaseQuery($dbQuery));
    }

    //DB Query for Products by Type ID
    // added p.id AS id, p.price_of_sale AS productPrice to query
    public function dataBaseQueryListProductsByTypeID($productTypeId)
    {
        $dbQuery = "SELECT t.name AS productTypeName, p.name AS productName, p.id AS id, p.price_of_sale AS productPrice
                            FROM product_types t
                            JOIN products p ON t.id = p.id_product_types
                            WHERE t.id = {$productTypeId};";

       $this->listGenerator->createProductListByID($this->dataBaseQuery($dbQuery));
    }

    // for Uebung4 - get all products with id, name and price
    public function dataBaseQueryallTypesByID()
    {
        $dbQuery = "SELECT name AS productName, id AS id, price_of_sale AS productPrice
                            FROM products ORDER BY id";

        return $this->dataBaseQuery($dbQuery);
    }

    // DB Connection and return retrieved Data
    public function dataBaseQuery($dbQuery)
    {
        $pdo = $this->pdo;
        $query = $dbQuery;
        $statement = $pdo->prepare($query);
        $statement->execute();
        $fetchedData = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $fetchedData;
    }
}