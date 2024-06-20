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
        Schema::create('m_user', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->autoIncrement()->nullable(false)->comment('ユーザID');
            $table->string('mail_address', 256)->nullable(false)->comment('メールアドレス');
            $table->string('password', 256)->nullable(false)->comment('パスワード');
            $table->string('user_name', 256)->nullable(false)->comment('ユーザ名');
            $table->string('user_name_kana', 256)->nullable(false)->comment('ユーザ名（かな）');
            $table->unsignedTinyInteger('default_area_id')->nullable(false)->comment('デフォルトエリアID');
            $table->boolean('is_admin')->nullable(false)->comment('管理者フラグ');
            $table->unsignedTinyInteger('area_id')->nullable(false)->default(6)->comment('エリアID');
            $table->foreign('area_id')->references('id')->on('m_area');
            $table->unsignedTinyInteger('attendance_id')->nullable(false)->default(6)->comment('勤怠ID');
            $table->foreign('attendance_id')->references('id')->on('m_attendance');
            $table->unsignedTinyInteger('user_status_id')->nullable(false)->default(5)->comment('ユーザステータスID');
            $table->foreign('user_status_id')->references('id')->on('m_user_status');
            $table->integer('created_id')->nullable()->comment('登録者');
            $table->integer('updated_id')->nullable()->comment('更新者');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
