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
        // variable um zweites if zu steuern
        $alreadyExists = false;

        //cart durchgehen, wenn die cart noch leer ist, wird der block gar nicht ausgeführt. darum das extra if nach diesem block
        foreach ($_SESSION["cartList"] as $key => $listItem) {
            //wenn artikel schon in cart ist, count um 1 erhöhen
            if ($listItem["id"] == $articleId) {
                $listItem["count"] += 1;
                //$key um genau das eine element das gefunden wurde zu ersetzen und den artikel nicht als ganzes noch einmal
                // in das session array schreibt
                $_SESSION["cartList"][$key] = $listItem;
                // variable auf true setzen, damit der untere block nicht noch ausgeführt wird
                $alreadyExists = true;
            }
        }
        // wenn der arikel in der cart nicht gefunden wurde bleibt die variable $alreadyExists false und dieser if block wird
        // ausgeführt
        if ($alreadyExists == false) {
            //komplette produktliste durchgehen
            foreach ($productList as $product) {
                // das gesuchte produkt um count = 1 erweitern und in die session speichern
                if ($articleId == $product["id"]) {
                    $product["count"] = 1;
                    $_SESSION["cartList"][] = $product;
                }
            }
        }
    }


    public function removeProductFromCart($articleId)
    {
        // cart durchgehen
        foreach ($_SESSION["cartList"] as $key => $listItem) {
            // wenn der artikel gefunden wurde, wird der block ausgeführt. wenn nicht passiert einfach gar nichts
            if ($articleId == $listItem["id"]) {
                // count um 1 reduzieren, wenn er dann 0 ist, die position im array löschen.
                // wenn es noch nicht null ist, das produkt mit dem neuen count wert an die selbe setzen [$key]
                //wo es bis jetzt war
                $listItem["count"] -= 1;
                if ($listItem["count"] == 0) {
                    unset($_SESSION["cartList"][$key]);
                } else {
                    $_SESSION["cartList"][$key] = $listItem;
                }
            }
        }
    }

    public function generateCartList()
    {
        $jsonOutput = ['cart' => $_SESSION["cartList"]];
        $this->jsonView->dataOutput($jsonOutput);
    }


}
