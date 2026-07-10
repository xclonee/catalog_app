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
        Schema::create('sales_transactions', function (Blueprint $table) {
            $table->id(); // id
            $table->string('no_transaksi')->unique(); // no_transaksi
            $table->timestamp('tanggal')->useCurrent(); // tanggal (timestamp auto)

            // foreign key ke tabel produk (menghubungkan product_id ke id di tabel products)
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->unsignedInteger('qty'); // qty

            // foreign key ke tabel merchants
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')->references('id')->on('merchants')->cascadeOnDelete();

            $table->timestamps(); // otomatis membuat created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_transactions');
    }
};
