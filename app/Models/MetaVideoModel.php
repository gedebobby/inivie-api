<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaVideoModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'meta_video', $hidden = ['created_at','updated_at'];

    public function property(){
        return $this->belongsTo(ListPropertyModel::class, 'list_property_id');
    }

    protected function video():Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'inivie_page/VideoProperty/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }
}
