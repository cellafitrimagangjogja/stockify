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
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();

            // Produk yang dilakukan stock opname
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Stok yang tercatat di sistem
            $table->integer('system_stock');

            // Stok hasil perhitungan fisik
            $table->integer('physical_stock');

            // Selisih stok fisik dengan stok sistem
            $table->integer('difference');

            // Tanggal dilakukan stock opname
            $table->date('opname_date');

            // Catatan
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_opnames');
    }
};