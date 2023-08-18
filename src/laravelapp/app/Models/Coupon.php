<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = "coupons";

    protected $fillable = [
        'user_id', // クーポンを発行するユーザーのID
        'price',   // クーポンの金額
        'used',    // クーポンが使用されたかどうかのフラグ
        // 'site_review_id'
    ];
    
    // クーポンとユーザーの関連付け
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
