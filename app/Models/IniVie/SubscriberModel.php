<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'subscribers', $hidden = ['created_at','updated_at'];

}
