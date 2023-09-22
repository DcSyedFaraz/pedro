<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function inspectionChecklist()
{
    return $this->belongsTo(InspectionChecklist::class);
}

public function inspectionResponses()
{
    return $this->hasMany(InspectionResponse::class);
}
}
