<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Repositories\ServiceFacility\ServiceFacilityInterface;
use Illuminate\Http\Request;

class ServiceFacilityController extends Controller
{
    public $service_facility;

    public function __construct(ServiceFacilityInterface $service_facility)
    {
        $this->service_facility = $service_facility;
    }

    public function getPropertyServices($slug_property){
        return $this->service_facility->getPropertyServices($slug_property);
    }
    
    public function addPropertyServices(Request $request){
        return $this->service_facility->addPropertyServices($request);
    }
    
    public function updatePropertyServices(Request $request, $property_id){
        return $this->service_facility->updatePropertyServices($request, $property_id);
    }   
    
    public function getPropertyFacilities($slug_property){
        return $this->service_facility->getPropertyFacilities($slug_property);
    }
    
    public function addPropertyFacilities(StoreFacilityRequest $request){
        return $this->service_facility->addPropertyFacilities($request);
    }
    
    public function updatePropertyFacilities(StoreFacilityRequest $request, $facility_id){
        return $this->service_facility->updatePropertyFacilities($request, $facility_id);
    }
    
    public function deletePropertyFacilities($facility_id){
        return $this->service_facility->deletePropertyFacilities($facility_id);
    }
    public function getFacilities(Request $request){
        return $this->service_facility->getFacilities($request);
    }
}
