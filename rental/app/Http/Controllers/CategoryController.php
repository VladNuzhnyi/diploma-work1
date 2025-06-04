<?php


namespace App\Http\Controllers;


use App\Http\DAL\Models\Category;

class CategoryController
{

    public function getCategories(){
        return Category::all();
    }

}
