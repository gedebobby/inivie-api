<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersVillaModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'offers_villa', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }
}
