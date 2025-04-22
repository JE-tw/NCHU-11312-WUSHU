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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id()->comment('會員詳細編號');

            $table->string('name', 50)->comment('姓名');
            $table->string('phone', 10)->comment('電話號碼');
            $table->date('birth_date')->nullable()->comment('出生日期');
            $table->time('birth_time')->nullable()->comment('出生時間');
            $table->string('birth_city', 10)->nullable()->comment('出生城市');
            $table->string('address', 50)->nullable()->comment('地址');

            $table->tinyInteger('status')->default(1)->comment('會員狀態：0-停權，1-使用中');

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
        Schema::dropIfExists('user_infos');
    }
};
