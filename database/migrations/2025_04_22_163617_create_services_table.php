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
        Schema::create('services', function (Blueprint $table) {
            $table->id()->comment('服務編號');

            $table->string('name', 50)->comment('服務名稱');
            $table->integer('price')->comment('金額');
            $table->string('introduction', 100)->comment('介紹');
            $table->softDeletes();
            $table->timestamps(); // 建立/更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
