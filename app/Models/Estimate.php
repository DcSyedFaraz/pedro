<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'phone' => 'array',
        'ext_id' => 'array',
        'ext' => 'array',
        'email' => 'array',
    ];

    public function customer()
    {
        return $this->hasOne(User::class,'id','customer_id');
    }

    public function job_category()
    {
        return $this->hasOne(job_Category::class,'id','job_cat_id');
    }

    public function job_prioirty()
    {
        return $this->hasOne(job_priority_category::class,'id','job_priority');
    }

    public function job_source()
    {
        return $this->hasOne(job_source_category::class,'id','job_source');
    }
}
