<?php

namespace App\Repositories\ServiceFacility;

interface ServiceFacilityInterface {
    public function getPropertyServices($slug_property);
    public function addPropertyServices($request);
    public function updatePropertyServices($request, $property_id);
    public function getPropertyFacilities($slug_property);
    public function addPropertyFacilities($request);
    public function updatePropertyFacilities($request, $facility_id);
    public function deletePropertyFacilities($request);
    public function getFacilities($request);
}