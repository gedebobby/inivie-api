<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyActivitiesRequest;
use App\Http\Requests\StorePropertyAwardRequest;
use App\Http\Requests\StorePropertyContactRequest;
use App\Http\Requests\StorePropertyDetailRequest;
use App\Http\Requests\StorePropertyMetaVideoRequest;
use App\Http\Requests\StorePropertyThemeRequest;
use App\Http\Requests\StoreSurpriseRequest;
use App\Http\Requests\StoreTestimonialRequest;
use App\Repositories\ListProperties\ListPropertiesInterface;
use Illuminate\Http\Request;

class ListPropertyController extends Controller
{
    
    public $list_properties;

    public function __construct(ListPropertiesInterface $list_properties)
    {
        $this->list_properties = $list_properties;
    }

    public function index(){
        return $this->list_properties->getAllListProperties();
    }

    public function getPropertyDetail($slug_property){
        return $this->list_properties->getPropertyDetail($slug_property);
    }

    public function addPropertyDetail(StorePropertyDetailRequest $request){
        return $this->list_properties->addPropertyDetail($request);
    }

    public function updatePropertyDetail(StorePropertyDetailRequest $request, $property_detail_id){
        return $this->list_properties->updatePropertyDetail($request, $property_detail_id);
    }

    public function getPropertyContact($slug_property){
        return $this->list_properties->getPropertyContact($slug_property);
    }

    public function addPropertyContact(StorePropertyContactRequest $request){
        return $this->list_properties->addPropertyContact($request);
    }

    public function updatePropertyContact(StorePropertyContactRequest$request, $contact_id){
        return $this->list_properties->updatePropertyContact($request, $contact_id);
    }

    public function getPropertyPageFacilities($slug_property, $slug_facility){
        return $this->list_properties->getPropertyPageFacilities($slug_property, $slug_facility);
    }
    
    public function getPropertyTestimonials($slug_property){
        return $this->list_properties->getPropertyTestimonials($slug_property);        
    }

    public function addPropertyTestimonials(StoreTestimonialRequest $request){
        return $this->list_properties->addPropertyTestimonials($request);        
    }

    public function updatePropertyTestimonials(StoreTestimonialRequest $request, $testimonial_id){
        return $this->list_properties->updatePropertyTestimonials($request, $testimonial_id);
    }

    public function deletePropertyTestimonials($testimonial_id){
        return $this->list_properties->deletePropertyTestimonials($testimonial_id);
    }
    
    public function getPropertySurprise($slug_property){
        return $this->list_properties->getPropertySurprise($slug_property);        
    }

    public function addPropertySurprise(StoreSurpriseRequest $request){
        return $this->list_properties->addPropertySurprise($request);        
    }
    
    public function updatePropertySurprise(StoreSurpriseRequest $request, $surprise_id){
        return $this->list_properties->updatePropertySurprise($request, $surprise_id);        
    }

    public function deletePropertySurprise($surprise_id){
        return $this->list_properties->deletePropertySurprise($surprise_id);
    }

    public function getPropertyPopup($slug_property){
        return $this->list_properties->getPropertyPopup($slug_property);        
    }

    public function getPropertyMetaVideo($slug_property){
        return $this->list_properties->getPropertyMetaVideo($slug_property);        
    }   
    
    public function addPropertyMetaVideo(StorePropertyMetaVideoRequest $request){
        return $this->list_properties->addPropertyMetaVideo($request);
    }
    
    public function updatePropertyMetaVideo(StorePropertyMetaVideoRequest $request, $meta_video_id){
        return $this->list_properties->updatePropertyMetaVideo($request, $meta_video_id);
    }

    public function getPropertyTheme($slug_property){
        return $this->list_properties->getPropertyTheme($slug_property);        
    }

    public function addPropertyTheme(StorePropertyThemeRequest $request){
        return $this->list_properties->addPropertyTheme($request);
    }
    
    public function updatePropertyTheme(StorePropertyThemeRequest $request, $theme_id){
        return $this->list_properties->updatePropertyTheme($request, $theme_id);
    }

    public function getPropertyAward($slug_property){
        return $this->list_properties->getPropertyAward($slug_property);
    }

    public function addPropertyAward(StorePropertyAwardRequest $request){
        return $this->list_properties->addPropertyAward($request);
    }

    public function updatePropertyAward(StorePropertyAwardRequest $request, $award_id){
        return $this->list_properties->updatePropertyAward($request, $award_id);
    }

    public function deletePropertyAward($award_id){
        return $this->list_properties->deletePropertyAward($award_id);
    }

    public function getPropertyActivities($slug_property){
        return $this->list_properties->getPropertyActivities($slug_property);
    }

    public function getPropertyActivitiesById($activity_id){
        return $this->list_properties->getPropertyActivitiesById($activity_id);
    }

    public function addPropertyActivities(StorePropertyActivitiesRequest $request){
        return $this->list_properties->addPropertyActivities($request);
    }

    public function updatePropertyActivities(StorePropertyActivitiesRequest $request, $activity_id){
        return $this->list_properties->updatePropertyActivities($request, $activity_id);
    }

    public function deletePropertyActivities($activity_id){
        return $this->list_properties->deletePropertyActivities($activity_id);
    }
    
    
}
