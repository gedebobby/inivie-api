<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPropertyDetailModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'list_property_detail', $hidden = ['created_at','updated_at'];

    // public function contact(){
    //     return $this->belongsTo(ContactModel::class, 'contact_id');
    // }

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }

    protected function logo():Attribute {
        return Attribute::make(
            get: fn ($value) => 'inivie_page/LogoProperty/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }
    protected function favicon():Attribute {
        return Attribute::make(
            get: fn ($value) => 'inivie_page/FaviconProperty/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }



}
