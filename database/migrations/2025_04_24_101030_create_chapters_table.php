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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16)->comment('章節名稱'); 
            $table->string('introduction', 40)->comment('章節簡介');
            $table->string('video_url')->comment('課程影片網址');
            $table->smallInteger('sort')->comment('章節排序');
            $table->unsignedBigInteger('course_id')->comment('課程編號');  //外鍵

            // 設定外鍵關聯，參照 courses 資料表的 id 欄位
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->unique(['name', 'course_id']);  // 設定章節名稱對於同一課程唯一
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
