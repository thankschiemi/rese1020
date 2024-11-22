<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('reservation_id'); // 予約ID
            $table->unsignedBigInteger('restaurant_id'); // 店舗ID
            $table->unsignedBigInteger('member_id'); // メンバーID
            $table->tinyInteger('rating')->comment('1～5の評価スコア'); // 評価スコア
            $table->text('comment')->nullable(); // コメント
            $table->timestamps(); // 作成・更新時刻

            // 外部キー制約
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade'); // `users` を `members` に変更
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
