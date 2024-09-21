<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagePopupsModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'page_popups', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }
}
