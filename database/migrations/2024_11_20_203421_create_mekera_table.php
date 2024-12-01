<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMekeraTable extends Migration
{
    public function up()
    {
        Schema::create('mekera', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Product name
            $table->decimal('price', 10, 2); // Product price
            $table->text('description')->nullable(); // Product description
            $table->integer('stock'); // Product stock
            $table->string('image_url'); // Path to the product image
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('mekera');
    }
}