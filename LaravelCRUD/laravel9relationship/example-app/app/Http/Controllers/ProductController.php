<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        // $cartegories= DB::select('select * from cartegories');
         return view('product.cartegory.index', compact('cartegories'));
     }
     public function create(){
 
         return view('admin.cartegory.create');
     }
}