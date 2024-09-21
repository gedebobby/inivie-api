<?php

namespace App\Models\IniVie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInquiryModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'sales_inquiries', $hidden = ['created_at','updated_at'];
    
}
