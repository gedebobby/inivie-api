<?php 

namespace App\Repositories\ListProperties;

interface ListPropertiesInterface {
    public function getAllListProperties();
    public function getPropertyDetail($slug_property);
    public function addPropertyDetail($request);
    public function updatePropertyDetail($request, $property_detail_id);
    public function getPropertyContact($slug_property);
    public function addPropertyContact($request);
    public function updatePropertyContact($request, $contact_id);
    public function getPropertyTestimonials($slug_property);
    public function addPropertyTestimonials($request);
    public function updatePropertyTestimonials($request, $testimonial_id);
    public function deletePropertyTestimonials($testimonial_id);
    public function getPropertyPageFacilities($slug_property, $slug_facility);
    public function getPropertySurprise($slug_property);
    public function addPropertySurprise($request);
    public function updatePropertySurprise($request, $surprise_id);
    public function deletePropertySurprise($surprise_id);
    public function getPropertyPopup($slug_property);
    public function getPropertyMetaVideo($slug_property);
    public function addPropertyMetaVideo($request);
    public function updatePropertyMetaVideo($request, $meta_video_id);
    public function getPropertyTheme($slug_property);
    public function addPropertyTheme($request);
    public function updatePropertyTheme($request, $theme_id);
    public function getPropertyAward($slug_property);
    public function addPropertyAward($request);
    public function updatePropertyAward($request, $award_id);
    public function deletePropertyAward($award_id);
    public function getPropertyActivities($slug_property);
    public function getPropertyActivitiesById($activity_id);
    public function addPropertyActivities($request);
    public function updatePropertyActivities($request, $activity_id);
    public function deletePropertyActivities($activity_id);
}

?>