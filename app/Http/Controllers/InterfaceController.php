<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
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
        $dataReq = $request->all();
        $data = $dataReq['data'];
        $adultId = Category::where('name', '18+')->first()->id;
        $userAdult = $dataReq['adult'];

        //check adult in search time
        $checkAdult = false;

        $now = Carbon::now();
        $tenDaysAgo = $now->subDays(10);

        $query = Product::query();

        if (array_key_exists('title', $data)) {
            $elasticSearchResults = Product::search($data['title'])->get();
            $countAdult = $elasticSearchResults->where('category_id', $adultId)->count();
            if($userAdult !== "true" && $countAdult){
                $checkAdult = true;
            }

            $elasticSearchResultsIds = $elasticSearchResults->pluck('id')->toArray();
            // dd($elasticSearchResultsIds);
            $query->whereIn('id', $elasticSearchResultsIds);
            // $query->where('product_details->title', 'like', '%' . $data['title'] . '%'); 
        }

        if (!$checkAdult && $userAdult !== "true") {
            $query->where('category_id', '!=', $adultId);
        }

        if (array_key_exists('category', $data)) {
            $query->where('category_id', $data['category']);
        }

        if (array_key_exists('cahsback100', $data)) {
            $query->where('product_details->cashback', '=', 100);
        }

        if (array_key_exists('procent', $data)) {
            $procent = (int) $data['procent'];
            if ($procent > 0) {
                $query->where('product_details->cashback', '>=', $procent);
            }
        }

       

        if (array_key_exists('sorting', $data)) {
            if ($data['sorting'] == 'max') {
                $query->orderByRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(product_details, "$.price_in_store")) AS UNSIGNED) DESC');
            } elseif ($data['sorting'] == 'min') {
                $query->orderByRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(product_details, "$.price_in_store")) AS UNSIGNED) ASC');
            }
        }

        $products = $query->with('images', 'category', 'videos')
            ->whereNotNull('category_id')
            ->orderByRaw("
                CASE 
                    WHEN top_at IS NOT NULL AND top_at >= ? THEN 0 
                    ELSE 1 
                END,
                top_at DESC,
                created_at DESC ", [$tenDaysAgo])
            ->get();

        foreach ($products as $key => $product) {
            if ($product->videos->count()) {
                $products[$key]->videos[0]->path = route('get-file', ['path' => $product->videos[0]->path]);
            } else {
                $products[$key]->images[0]->path = route('get-file', ['path' => $product->images[0]->path]);
            }
        }

        return response()->json(['data' => $products, 'adult' => $checkAdult]);


    }

    public function getProducts(Request $request)
    {
        // dd($request->all());
        $now = Carbon::now();

        //find 18+ category id;
        $adultId = Category::where('name', '18+')->first()->id;
        //get user adul result
        $adult = $request->adult;
        //check filter adults
        $checkAdult = false;

        $tenDaysAgo = $now->subDays(10);

        $product = Product::query();

        $product->with([
            'images',
            'videos',
            'category'
        ])
            ->whereNotNull('category_id');

        if ($adult !== "true") {
            $product->where('category_id', '!=', $adultId);
        }

        $product->orderByRaw("
                CASE 
                    WHEN top_at IS NOT NULL AND top_at >= ? THEN 0 
                    ELSE 1 
                END,
                top_at DESC,
                created_at DESC ", [$tenDaysAgo]);


        $products = $product->get();

        foreach ($products as $key => $product) {
            if ($product->videos->count()) {
                $products[$key]->videos[0]->path = route('get-file', ['path' => $product->videos[0]->path]);
            } else {
                $products[$key]->images[0]->path = route('get-file', ['path' => $product->images[0]->path]);
            }
        }
        return response()->json(['data' => $products, 'adult' => $checkAdult]);
    }

}
