<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
      $products = Product::all();
//デバッグ用
// $sql = User::toSql();
// echo "<pre>\n";var_dump($sql,$users);

    dd($products);

      return view('top', ['products' => $products]);
    }
}
