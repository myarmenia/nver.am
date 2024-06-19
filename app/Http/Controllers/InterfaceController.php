<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class InterfaceController extends Controller
{
    

    public function index()
    {
        $products = Product::with('images', 'category')->whereNotNull('category_id')->orderBy('id', 'desc')->get();
        $categories = Category::all();

        return view('content.interface.index', compact('products', 'categories'));
    }

    public function detail(int $id)
    {
        $product = Product::with('images', 'category')->find($id);
      
        return view('content.interface.product-detail', compact('product'));  
    }

}
