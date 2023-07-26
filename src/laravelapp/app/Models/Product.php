<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
        'category_id'
        
    ];

    // 論理削除のカラム名を指定（デフォルトは'deleted_at'）
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
