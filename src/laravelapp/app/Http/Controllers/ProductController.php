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
        return view('top', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // 指定された商品IDの商品を取得,findOrFailで例外も処理

        return view('products.show', compact('product')); // 商品詳細ページのビューに商品情報を渡す
    }

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
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string', // タグの入力値は文字列としてバリデーション
            
        ]);

        // dd($validatedData); // バリデートされたデータを確認

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
        if ($request->has('tags')) {
            $tags = $validatedData['tags'];
            $tagIds = [];
        
            foreach ($tags as $tag) {
                if ($tag !== null && $tag !== '') { // タグ名が空でない場合のみ保存
        
                    // タグ名がテーブルに存在しない場合のみ新規作成
                    $tagModel = Tag::firstOrCreate(['name' => $tag]);
        
                    // 中間テーブルにタグを関連付け（既に関連付けられている場合は重複しないように）
                    $tagIds[] = $tagModel->id;
                }
            }
        
            $product->tags()->syncWithoutDetaching($tagIds);
        }

        dd($product); // 保存された商品データを確認
    
        return redirect()->route('products.index')->with('success', '商品が出品されました');

        // dd(session()->all());
    }

}