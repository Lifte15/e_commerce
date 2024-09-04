<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->text('description');
        $table->decimal('price', 8, 2);
        $table->integer('stock');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};