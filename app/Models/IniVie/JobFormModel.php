<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobFormModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'job_form', $hidden = ['created_at','updated_at'];

    protected function file():Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'inivie/FormJob/' . $value
            // set: fn ($value) => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)))
        );
    }
}
