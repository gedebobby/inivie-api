<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurprisesModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'surprises', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }
}
