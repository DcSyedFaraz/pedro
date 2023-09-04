<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Caryley\LaravelInventory\HasInventory;

class Product extends Model
{
    use HasFactory,HasInventory;
    protected $guarded = [];
}
