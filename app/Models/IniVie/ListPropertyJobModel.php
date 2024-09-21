<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPropertyJobModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'list_properties_job', $hidden = ['created_at','updated_at'];
}
