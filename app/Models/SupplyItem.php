<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsTo(Job::class);
    }
}
