<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'services', $hidden = ['pivot', 'created_at','updated_at'];

    public function icon(){
        return $this->belongsTo(IconModel::class, 'icon_id');
    }

    public function property_services(){
        return $this->belongsToMany(ListPropertyModel::class, 'property_services', 'services_id', 'list_property_id');
    }

}
