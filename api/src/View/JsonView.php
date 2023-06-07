<?php

class JsonView {

    public function __construct() {
        header("Content-Type: application/json");
    }

    public function dataOutput($data) {

        echo json_encode($data,  JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
