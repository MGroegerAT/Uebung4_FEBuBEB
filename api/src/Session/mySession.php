<?php

session_start();
class mySession
{

    public function __construct() {
        $this->sessionCount = $_SESSION["sessionCount"];
        $this->jsonView = new \JsonView();
    }

    public function addArticle($count) {
        $this->sessionCount += $count;
        $_SESSION["sessionCount"] = $this->sessionCount;

    }

    public function removeArticle($count) {
        $this->sessionCount -= $count;
        $_SESSION["sessionCount"] = $this->sessionCount;
        //echo("remove");
    }

    public function showArticleList() {
        $output = ['sessionCount' => $_SESSION["sessionCount"]];
        $this->jsonView->dataOutput($output);


    }

}