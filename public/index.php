<?php

require '../config.php';
require '../vendor/autoload.php';

use App\Controllers\ProductController;

(new ProductController)->index();



