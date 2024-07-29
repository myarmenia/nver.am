<?php

namespace App\Http\Controllers\TmpProduct;

use App\Http\Controllers\Controller;
use App\Models\TmpProduct;
use Illuminate\Http\Request;

class TmpProductController extends Controller
{
    public function index()
    {
        $products = TmpProduct::all();

        return view('content.tmp-product.index', compact('products'));
    }

    public function destroy($id)
    {
        TmpProduct::find($id)->delete();
        return back();
    }
}
