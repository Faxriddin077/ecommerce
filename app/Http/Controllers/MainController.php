<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Subsciption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
        \App\Services\CurrencyRates::getRates();

        $productQuery = Product::with('category');
        dd(\request()->url());
        if ($request->filled('price_from')) {
            $productQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit', 'new', 'recommend'] as $item) {
            if ($request->has($item)) {
                $productQuery->$item();
            }
        }

        $products = $productQuery->paginate(6)->withPath("?" . $request->getQueryString());
        return view('index', compact('products'));
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        return view('product', compact('product'));
    }

    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subsciption::create([
            'email' => $request->email,
            'product_id' => $product->id
        ]);
        return redirect()->back()->with('success', 'Rahmat, biz albatta siz bn boglanamiz');
    }

    public function changeLocale($locale)
    {
        $availableLocales = ['ru', 'en'];
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function changeCurrency($currencyCode) {
//        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currencyCode]);
        return redirect()->back();
    }
}
