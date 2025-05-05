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
        Schema::create('courses', function (Blueprint $table) {
            $table->id()->comment('課程編號');

            $table->string('name', 30)->comment('課程名稱');

            $table->unsignedBigInteger('category_id')->comment('課程類別編號');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('price')->comment('金額');
            $table->string('introduction', 36)->comment('列表簡介');
            $table->string('detail', 500)->comment('詳細介紹');

            $table->tinyInteger('is_featured')->default(0)->comment('主打課程：0-否、1-是');

            $table->timestamps(); // 建立/更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
