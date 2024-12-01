<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'mekera'; // Specify the table name if it's different from the default

    // Define the fillable attributes
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'image_url',
    ];
}