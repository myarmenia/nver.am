<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    
    public function index()
    {
        $data = Category::all();

        return view('content.category.index', ['data' => $data]);
    }

    public function addCategory(Request $request)
    {
       if($category = $request->input('category')){

            if(Category::where('name', $category)->first()){
                session(['errorMessage' => 'Կատեգորիան արդեն գոյություն ունի']);

                return redirect()->back();
            }

           Category::create([
               'name' => $category,
           ]);
   
           session(['success' => 'Կատեգորիան ավելացված է։']);
           return redirect()->back();
       }
       
       session(['errorMessage' => 'Ինչ որ բան այն չէ։']);

       return redirect()->back();
    }

}
