<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFacilitiesModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'page_facilities', $hidden = ['created_at','updated_at'];

    public function facilities_list(){
        return $this->belongsTo(FacilitiesListModel::class, 'facilities_list_id');
    }
}
