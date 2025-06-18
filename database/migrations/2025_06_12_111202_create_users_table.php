<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // id
        $table->string('name', 30); // 名前
        $table->string('email', 100)->unique(); // メール（ユニーク制約）
        $table->string('password', 255); // パスワード（ハッシュされるため長めに）
        $table->boolean('is_Admin')->default(0); // 管理者フラグ
        $table->timestamp('created_at')->useCurrent(); // 登録日時
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
