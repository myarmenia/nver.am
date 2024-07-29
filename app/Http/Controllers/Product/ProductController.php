<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Product\ProductService;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::with(['images', 'videos'])->where('active', 0)->orderBy('id', 'desc')->get();
        $categories = Category::all();

        return view('content.product.index', ['products' => $products, 'categories' => $categories]);
    }

    public function addProduct(Request $request)
    {
        $readyData = $this->productService->addProduct();

        return redirect()->back();
    }

    public function editProduct(EditProductRequest $request, $id)
    {
        $this->productService->editProduct($request->all(), $id);
                
        return redirect()->back();
    }

    public function deleteProduct(int $id)
    {
        $product = Product::find($id);
        $productId = $product->id;
        $directoryPath = storage_path("app/public/telegram/$productId");

        if (File::exists($directoryPath)) {
            File::deleteDirectory($directoryPath);
        }

        $product->delete();

        return redirect()->back();
    }
}
