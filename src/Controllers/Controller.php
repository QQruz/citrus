<?php

namespace App\Controllers;

abstract class Controller {

    protected $viewsPath;

    public function __construct() {
        $this->viewsPath = VIEWS_PATH;
    }

    protected function view(string $file, $data = null) {
        require $this->viewsPath . $file . '.php';
    }
}