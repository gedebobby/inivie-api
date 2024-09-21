<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyOfferModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'property_offer', $hidden = ['created_at','updated_at'];

}
