<?php 

namespace App\Repositories\Offers;

interface OffersInterface {
    
    public function getOffersVilla($request);
    public function getPropertyOffersVilla($slug_property);
    public function addPropertyOffersVilla($request);
    public function updatePropertyOffersVilla($request, $offer_id);
    public function deletePropertyOffersVilla($offer_id);
    public function getIniVieOffers();
    public function getIniVieOffersById($id);
    public function getPropertiesIniVieOffer($offer_id);
    public function getPropertyOffersIniVie($slug_property);
    public function addIniVieOffers($request);
    public function updateIniVieOffers($request, $id);
    public function deleteIniVieOffers($id);
}