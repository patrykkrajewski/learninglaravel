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
        Schema::create('stock_controls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('invoice_id');
            $table->string('product_name')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->integer('quantity');
            $table->date('operation_date');
            $table->string('move_to');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_controls');
    }
};