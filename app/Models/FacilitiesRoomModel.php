<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesRoomModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'facilities_room', $hidden = ['pivot', 'created_at','updated_at'];

    public function room(){
        return $this->belongsToMany(RoomListModel::class, 'room_facilities_detail', 'facilities_room_id', 'room_list_id');
    }
    
    public function icon(){
        return $this->belongsTo(IconModel::class, 'icon_id');
    } 


}
