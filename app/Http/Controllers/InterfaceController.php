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

    public function filterSearch(Request $request)
    {
        $data = $request->data;

        $query = Product::query();

        if (array_key_exists('title', $data)) {
            $elasticSearchResults = Product::search($data['title'])->get()->pluck('id')->toArray();
            $query->whereIn('id', $elasticSearchResults);
            // $query->where('product_details->title', 'like', '%' . $data['title'] . '%');
        }

        if (array_key_exists('category', $data)) {
            $query->where('category_id', $data['category']);
        }

        if (array_key_exists('procent', $data)) {
            $procent = (int) $data['procent'];
            if($procent > 0){
                $query->where('product_details->cashback', '<=', $procent);
            }
        }

        if (array_key_exists('sorting', $data)) {
            if ($data['sorting'] == 'max') {
                $query->orderByRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(product_details, "$.price_in_store")) AS UNSIGNED) DESC');
            } elseif ($data['sorting'] == 'min') {
                $query->orderByRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(product_details, "$.price_in_store")) AS UNSIGNED) ASC');
            }
        }

        $products = $query->with('images', 'category')->whereNotNull('category_id')->orderBy('updated_at', 'desc')->get();

        foreach ($products as $key => $product) {

            $products[$key]->images[0]->path = route('get-file', ['path' => $product->images[0]->path]);

        }

        return response()->json($products);

    }

}
