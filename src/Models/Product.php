<?php

namespace App\Models;

use App\Models\Model;

class Product extends Model {

    protected $table = 'products';

    protected $columns = ['image', 'title', 'description'];
}