<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTypeModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'ini_vie_property_type', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->hasMany(PropertyModel::class, 'property_type_id');
    }
}
