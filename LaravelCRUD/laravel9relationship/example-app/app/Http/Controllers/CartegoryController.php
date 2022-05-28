<?php

namespace App\Http\Controllers;

use App\Models\Cartegory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartegoryController extends Controller
{
    public function index(){
       $cartegories= DB::select('select * from cartegories');
        return view('admin.cartegory.index', compact('cartegories'));
    }
    public function create(){

        return view('admin.cartegory.create');
    }
    public function store(Request $request){
        Cartegory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        
        return redirect('admin/cartegory')->with('message','Added Successfully');
    }
    
}
