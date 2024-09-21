<?php

namespace App\Models;

use App\Models\IniVie\PropertyOfferModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'offers', $hidden = ['created_at','updated_at', 'pivot'];

    public function property(){
        return $this->belongsToMany(ListPropertyModel::class, 'property_offer', 'offer_id', 'list_property_id');
    }

    public function property_offer(){
        return $this->hasOne(PropertyOfferModel::class, 'offer_id');
    }

    protected function offerSlug():Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value))),
            set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }

    protected function photo():Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'inivie/Offers/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }

    
}
