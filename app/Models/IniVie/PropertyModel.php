<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'ini_vie_properties', $hidden = ['created_at','updated_at'];
    
}
