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
        Schema::create('contact_records', function (Blueprint $table) {
            $table->id()->comment('紀錄編號');

            $table->string('name', 50)->comment('姓名');
            $table->string('phone', 10)->comment('電話（手機號碼）');
            $table->string('email')->comment('電子信箱');
            $table->string('title', 20)->comment('主旨');
            $table->text('content')->comment('內容');

            $table->timestamps(); // 建立/更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_records');
    }
};
