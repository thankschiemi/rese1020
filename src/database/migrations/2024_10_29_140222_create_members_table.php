<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id'); // ユーザーID
            $table->string('name', 255); // ユーザー名
            $table->string('email', 255)->unique(); // メールアドレス（ユニーク）
            $table->timestamp('email_verified_at')->nullable(); // メール認証日時
            $table->string('password', 255); // パスワード
            $table->rememberToken(); // ログイン状態保持トークン
            $table->timestamps(); // 作成日時・更新日時
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}
