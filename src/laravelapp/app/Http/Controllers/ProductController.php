<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
      $products = Product::paginate(12); // 1ページに12個の商品を表示するページネーションを実装
      // dd($products);
      return view('top', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::find($id); // 指定された商品IDの商品を取得

        return view('products.show', ['product' => $product]); // 商品詳細ページのビューに商品情報を渡す
    }
}
