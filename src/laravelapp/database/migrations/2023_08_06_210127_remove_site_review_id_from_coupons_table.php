<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSiteReviewIdFromCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            // 外部キー制約の削除
            $table->dropForeign(['site_review_id']);
            // site_review_idカラムを削除
            $table->dropColumn('site_review_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->foreignId('site_review_id')->constrained('seller_reviews'); //外部キー制約
        });
    }
}
