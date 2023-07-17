<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(12); // 1ページに12個の商品を表示するページネーションを実装
        // dd($products);
        return view('top', ['products' => $products]);
    }

    // public function show($id)
    // {
    //     $product = Product::find($id); // 指定された商品IDの商品を取得

    //     return view('products.show', ['product' => $product]); // 商品詳細ページのビューに商品情報を渡す
    // }

    public function create()
    {
        // カテゴリーの一覧を取得
        $categories = Category::all();
                
        // タグの一覧を取得
        $tags = Tag::all();
        
        
        return view('products.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required' , 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            // 'tag_id' => 'nullable|array', // タグIDを配列で受け取る
            // 'tag_id.*' => ['exists:tags,id'], // 選択されたタグIDが存在することを確認
            'new_tag' => ['nullable' , 'string']
            
        ]);

        

        $user_id = auth()->user()->id; // ログインユーザーのIDを取得

        $validatedData['user_id'] = $user_id; // ユーザーIDを代入
        
        // Product::create($validatedData);
    
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = (int) $validatedData['price'];
        $product->user_id = $validatedData['user_id'];
        $product->category_id = $validatedData['category_id'];
        $product->save();
    
        // タグの関連付け
        if ($request->has('tag_id')) {
            $product->tags()->attach($request->input('tag_id'));
        }
    
        // 新しいタグが入力されている場合は保存
        if ($request->has('new_tag')) {
            $tag = new Tag();
            $tag->name = $request->input('new_tag');
            $tag->save();
            $product->tags()->attach($tag->id);
        }
    
        return redirect()->route('products.index')->with('success', '商品が出品されました');

        dd(session()->all());
    }

}