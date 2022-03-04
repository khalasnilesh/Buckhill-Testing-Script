<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('order_status_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('SET NULL');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('SET NULL');
            $table->uuid('uuid')->default(DB::raw('(UUID())'));
            $table->json('products');
            $table->json('address');
            $table->float('delivery_fee', 8, 2)->nullable();
            $table->float('amount', 8, 2);
            $table->timestamps();
            $table->timestamp('shipped_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
