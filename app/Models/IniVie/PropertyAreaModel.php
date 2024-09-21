<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAreaModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'ini_vie_property_area', $hidden = ['created_at','updated_at'];

}
