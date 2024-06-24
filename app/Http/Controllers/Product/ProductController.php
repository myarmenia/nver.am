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
        $products = Product::with('images')->whereNull('category_id')->orderBy('id', 'desc')->get();
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
        $data = $request->all();
        $product = Product::find($id);
        $decodedDetail = json_decode($product->product_details, true);
        $product->category_id = $data['category_id'];
        unset($data['category_id']);
        $data['title_am'] = $decodedDetail['title_am'] ?? '';
        $product->product_details = json_encode($data, JSON_UNESCAPED_UNICODE);

        $product->save();
        session(['success' => 'Продукт был модифицирован и одобрен.']);
        
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
