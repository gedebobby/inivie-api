<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPositionModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'job_positions', $hidden = ['created_at','updated_at'];
}
