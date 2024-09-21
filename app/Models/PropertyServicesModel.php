<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyServicesModel extends Model
{
    use HasFactory;

    protected $guarded = [], $table = 'property_services', $hidden = ['created_at','updated_at'];
    
}
