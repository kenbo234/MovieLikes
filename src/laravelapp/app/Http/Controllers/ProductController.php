<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
      $products = Product::paginate(9); // 1ページに9個の商品を表示するページネーションを実装
      // dd($products);
      return view('top', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::find($id); // 指定された商品IDの商品を取得

        return view('products.show', ['product' => $product]);
    }
}
