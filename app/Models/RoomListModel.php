<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomListModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'room_list', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }

    public function gallery(){
        return $this->hasMany(GalleryModel::class, 'room_list_id');
    }

    public function facilities(){
        return $this->belongsToMany(FacilitiesRoomModel::class, 'room_facilities_detail', 'room_list_id', 'facilities_room_id');
    }

    protected function slug():Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value))),
            set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }

    protected function photo():Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'inivie_page/RoomProperty/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }
    
}
