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
        Schema::create('m_area', function (Blueprint $table) {
            $table->tinyIncrements('id')->nullable(false)->comment('エリアID');
            $table->string('area_name', 256)->nullable(false)->comment('エリア名');
            $table->boolean('is_default_area')->nullable(false)->comment('デフォルトエリアフラグ');
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
        Schema::dropIfExists('m_area');
    }
};
