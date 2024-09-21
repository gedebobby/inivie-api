<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\List_;

class ListPropertyModel extends Model
{
    use HasFactory;
    protected $guarded = [], $table = 'list_properties', $hidden = ['created_at','updated_at', 'pivot'];

    public function property_services(){
        return $this->belongsToMany(ServicesModel::class, 'property_services', 'list_property_id', 'services_id');
    }

    public function property_detail(){
        return $this->hasOne(ListPropertyDetailModel::class, 'list_property_id');
    }

    public function popup(){
        return $this->hasOne(PagePopupsModel::class, 'list_property_id');
    }

    public function theme_color(){
        return $this->hasOne(ThemeColorModel::class, 'list_property_id');
    }

    public function meta_video(){
        return $this->hasOne(MetaVideoModel ::class, 'list_property_id');
    }

    public function testimonials(){
        return $this->hasMany(TestimonialModel::class, 'list_property_id');
    }
    
    public function album(){
        return $this->hasMany(AlbumModel::class, 'list_property_id');
    }

    public function facilities(){
        return $this->hasMany(FacilitiesListModel::class, 'list_property_id');
    }

    public function contact(){
        return $this->hasOne(ContactModel::class, 'list_property_id');
    }

    public function surprises(){
        return $this->hasMany(SurprisesModel::class, 'list_property_id');
    }

    public function offers(){
        return $this->hasMany(OffersModel::class, 'list_property_id');
    }

    public function awards(){
        return $this->hasMany(AwardsModel::class, 'list_property_id');
    }
    






}
