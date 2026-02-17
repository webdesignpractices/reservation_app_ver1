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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            //外部キー制約
            $table->foreignId('user_id')->constrained();
            $table->foreignId('staff_id')->constrained('staff');
            $table->foreignId('service_id')->constrained();
            
            //予約時間
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            
            $table->text('memo')->nullable();
            $table->string('status')->default('confirmed');
            $table->timestamps();
            //インデックス（検索スピード向上のため）
            $table->index(['user_id','service_id','staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
