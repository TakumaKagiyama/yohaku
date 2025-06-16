<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_images', function (Blueprint $table) {
            $table->id(); // id（BIGINT, AUTO_INCREMENT, 主キー）
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->string('image_path', 255); // 画像パス
            $table->string('mime_type', 100)->nullable(); // MIMEタイプ
            $table->integer('file_size')->nullable(); // ファイルサイズ（バイト）
            $table->timestamp('created_at')->useCurrent(); // 作成日時
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // 更新日時

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_images');
    }
};
