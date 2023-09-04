<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WorkOrders extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->code = Str::uuid()->toString(); // Generate a UUID as the code
        });
    }

}
