<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryAlbumPhotoModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'gallery_album_photo', $hidden = ['created_at','updated_at'];

    public function album(){
        return $this->belongsTo(AlbumModel::class, 'album_id');
    }
}
