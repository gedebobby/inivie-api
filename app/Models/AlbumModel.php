<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'albums', $hidden = ['created_at','updated_at'];

    public function gallery_photo_album(){
        return $this->hasMany(GalleryAlbumPhotoModel::class, 'album_id');
    }

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }



    // public function list_property() {
    //     return $this->belongsTo(ListPropertyModel::class);
    // }

    // public function photo(){
    //     return $this->belongsToMany(PhotoModel::class, 'gallery', 'album_id', 'photo_id');
    // }
}
