<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categorias = Category::all();
        return $categorias;

    }
}
