<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'gallery', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }
    
    public function album(){
        return $this->hasMany(AlbumModel::class, 'gallery_id');
    }

    protected function image():Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'inivie_page/RoomProperty/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }
}
