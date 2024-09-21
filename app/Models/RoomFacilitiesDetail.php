<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacilitiesDetail extends Model
{
    use HasFactory;    
    protected $guarded = [], $table = 'room_facilities_detail', $hidden = ['created_at','updated_at'];
}
