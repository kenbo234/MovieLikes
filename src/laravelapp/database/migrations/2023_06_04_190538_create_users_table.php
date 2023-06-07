<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 128)->nullable(false)->comment('ユーザー名');
            $table->string('email', 254)->unique()->nullable(false)->comment('メールアドレス');
            $table->string('password', 255)->nullable(false)->comment('パスワード');
            $table->char('zipcode', 7)->nullable(false)->comment('郵便番号');
            $table->string('prefecture')->nullable(false)->comment('都道府県');
            $table->string('city')->nullable(false)->comment('市町村');
            $table->string('housenumber')->nullable(false)->comment('番地');
            $table->string('buildingname')->comment('建物名');
            $table->timestamps();
            $table->collation = 'utf8mb4_bin';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
