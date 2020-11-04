<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request){
        $productQuery = Product::with('category');
        if ($request->filled('price_from')){
            $productQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')){
            $productQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit', 'new', 'recommend'] as $item) {
            if ($request->has($item)){
                $productQuery->$item();
            }
        }

        $products = $productQuery->paginate(6)->withPath("?" . $request->getQueryString());
        return view('index', compact('products'));
    }

    public function category($code){
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }
    public function categories(){
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function product($category, $product = null){
        return view('product', ['product' => $product]);
    }
}
