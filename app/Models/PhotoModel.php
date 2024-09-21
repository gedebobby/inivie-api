<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'photos', $hidden = ['created_at','updated_at'];

    // public function album() {
    //     return $this->belongsToMany(AlbumModel::class, 'gallery', 'photo_id', 'album_id');
    // }
}
