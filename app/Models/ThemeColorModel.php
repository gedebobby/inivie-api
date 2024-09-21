<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeColorModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'theme_color', $hidden = ['created_at','updated_at'];
}
