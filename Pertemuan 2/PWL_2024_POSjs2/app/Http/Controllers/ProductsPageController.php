<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsPageController extends Controller
{
    public function products() {
        return view('products');
    }

    public function food_beverage() {
        return view('category.food-beverage');
    }

    public function home_care() {
        return view('category.home-care');
    }

    public function beauty_health() {
        return view('category.beauty-health');
    }

    public function baby_kid() {
        return view('category.baby-kid');
    }
}
