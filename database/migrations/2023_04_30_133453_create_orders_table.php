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
            $table->foreignId('customers');
            $table->json('product_details');
            $table->double('total_amount');
            $table->double('discount_amount')->default(0);
            $table->double('advance_amount')->default(0);
            $table->double('delivery_charge');
            $table->longtext('note')->nullable();
            $table->string('status')->default('pending');
            $table->string('order_place');
            $table->string('order_process_by')->nullable();
            $table->string('booking_number')->nullable();
            $table->string('courier_name')->nullable();
            $table->timestamps();
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
