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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id()->comment('訂單品項編號');

            // 與 orders 表的外鍵關聯
            $table->unsignedBigInteger('order_id')->comment('訂單編號'); // 對應 orders 表
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // 多型關聯欄位
            $table->unsignedBigInteger('product_id')->comment('商品ID'); // 多型
            $table->string('product_type')->comment('商品類型'); // （App\\Models\\Course 或 App\\Models\\Service）

            $table->integer('price_at_order_time')->comment('訂購當下價格');
            $table->boolean('is_accessible')->default(false)->comment('權限狀態：false=未開啟，true=已開啟');

            $table->timestamps(); // 建立時間 / 更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
