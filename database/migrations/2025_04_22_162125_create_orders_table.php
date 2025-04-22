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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->comment('訂單編號');

            $table->integer('total_amount')->comment('訂單總金額');
            $table->tinyInteger('status')->default(0)->comment('訂單狀態：0-尚未付款，1-等待客服確認款項，2-已確認付款，3-取消訂單');

            $table->date('remittance_date')->nullable()->comment('匯款日期');
            $table->integer('remittance_amount')->nullable()->comment('匯款金額');

            $table->string('remittance_account')->nullable()->comment('匯款帳號');
            $table->string('remittance_account_last5', 5)->nullable()->comment('匯款帳號末五碼');

            $table->unsignedBigInteger('user_id')->comment('會員編號');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // 建立時間 / 更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
