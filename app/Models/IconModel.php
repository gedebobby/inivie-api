<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'icon', $hidden = ['created_at','updated_at'];

    public function property_services(){
        return $this->belongsToMany(IconModel::class, 'property_services', 'icon_id', 'list_property_id');
    }
}
