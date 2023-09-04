<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
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
    // 'customer','job_category','job_prioirty','job_source',

    public function getParsedStatusAttribute()
    {
        if($this->attributes['current_status'] == 1) {
            return 'Unscheduled';
        } else if($this->attributes['current_status'] == 2) {
            return 'Scheduled';
        } else if($this->attributes['current_status'] == 3) {
            return 'Dispatch';
        } else if($this->attributes['current_status'] == 4) {
            return 'Canceled';
        } else if($this->attributes['current_status'] == 5) {
            return 'Rescheduled';
        } else if($this->attributes['current_status'] == 6) {
            return 'On Site';
        } else if($this->attributes['current_status'] == 7) {
            return 'In Process';
        } else if($this->attributes['current_status'] == 8) {
            return 'Partially';
        } else if($this->attributes['current_status'] == 9) {
            return 'Completed';
        }  
        return '';
    }

    protected $appends = ['parsedStatus'];
}
