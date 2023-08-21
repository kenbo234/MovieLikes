<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Purchase;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_purchased', false)->paginate(12); // 購入されてない商品を1ページに12個の商品を表示するページネーションを実装
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
            'price' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string', // タグの入力値は文字列としてバリデーション
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像のバリデーション

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

        // 画像をアップロードして保存先のパスを取得
        $imagePath = $request->file('image')->store('images', 'public');


        // Imageモデルに新しいレコードを作成し、データベースに保存
        $image = new Image();
        $image->user_id = $user_id;
        $image->product_id = $product->id;
        $image->image_url = $imagePath;
        $image->save();

        // ここで$product->image_idに$image->idを設定する
        $product->image_id = $image->id;
        $product->save();

        return redirect()->route('products.index')->with('success', '商品が出品されました');
    }

    public function purchase($id)
    {
        // ログインしていないユーザーの場合、ログインページにリダイレクトさせる
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'このページを閲覧するにはログインが必要です。');
        }

        // 購入処理を行うコードを追加
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.show', ['id' => $id])->with('error', '商品が見つかりません');
        }

        $user = Auth::user();

        // 購入情報を保存
        $purchase = new Purchase();
        $purchase->user_id = $user->id;
        $purchase->product_id = $product->id;
        $purchase->price = $product->price;
        $purchase->purchased_at = now();
        $purchase->save();

        // 商品のフラグを更新
        $product->is_purchased = true;
        $product->save();

        return redirect()->route('show_seller_review_form', ['product_id' => $id])->with('success', '商品を購入しました');
    }

    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword'));

        // キーワードが空でない場合のみ検索を行う
        if (!empty($keyword)) {
            // 全角・半角の空白を削除
            $keyword = preg_replace('/\s+/u', '', $keyword);

            // 検索処理を実装
            $products = Product::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhereHas('tags', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                })
                ->paginate(12);

            return view('top', compact('products'));
        } else {
            // キーワードが空の場合は何も検索せずにトップページを表示
            return redirect()->route('products.index');
        }
    }
}
