<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\Comment;

class ProductController extends Controller {
    
    public function index() {
        $data = [
            'products' => (new Product)->all(),
            'comments' => (new Comment)->approved()
        ];

        $this->view('index', $data);
    }
}