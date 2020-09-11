<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $connection = 'bsale_test';

    protected $table = 'product';
}
