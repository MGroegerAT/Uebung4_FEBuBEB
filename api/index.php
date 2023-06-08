<?php


include "config/config.php";

header('Access-Control-Allow-Origin: *');




$controller = new Controller();
$controller->route();

