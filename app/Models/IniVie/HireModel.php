<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'hire', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyJobModel::class, 'list_property_job_id');
    }

    public function job_position(){
        return $this->belongsTo(JobPositionModel::class, 'job_position_id');
    }
}
