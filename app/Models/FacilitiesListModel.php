<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesListModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'facilities_list', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }

    public function page_facilities(){
        return $this->hasOne(PageFacilitiesModel::class, 'facilities_list_id');
    }

    protected function photo():Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'inivie_page/FacilityListProperty/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }


}
