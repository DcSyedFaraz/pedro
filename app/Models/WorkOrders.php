<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WorkOrders extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function jobname()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }
    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
    public function files()
    {
        return $this->hasMany(Files::class,'job_id','job_id');
    }


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($order) {
    //         $order->code = Str::uuid()->toString(); // Generate a UUID as the code
    //     });
    // }

}
