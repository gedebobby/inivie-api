<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\StorePropertyOfferRequest;
use App\Repositories\Offers\OffersInterface;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public $offer;

    public function __construct(OffersInterface $offer){
        $this->offer = $offer;
    }

    public function getOffersVilla(Request $request){
        return $this->offer->getOffersVilla($request);
    }

    public function getPropertyOffersVilla($slug_property){
        return $this->offer->getPropertyOffersVilla($slug_property);        
    }

    public function addPropertyOffersVilla(StorePropertyOfferRequest $request){
        return $this->offer->addPropertyOffersVilla($request);        
    }

    public function updatePropertyOffersVilla(StorePropertyOfferRequest $request, $offer_id){
        return $this->offer->updatePropertyOffersVilla($request, $offer_id);
    }

    public function deletePropertyOffersVilla($offer_id){
        return $this->offer->deletePropertyOffersVilla($offer_id);
    }

    public function getIniVieOffers(){
        return $this->offer->getIniVieOffers();
    }
    
    public function getIniVieOffersById($id){
        return $this->offer->getIniVieOffersById($id);
    }

    public function getPropertiesIniVieOffer($offer_id){
        return $this->offer->getPropertiesIniVieOffer($offer_id);
    }

    public function addIniVieOffers(StoreOfferRequest $request){
        return $this->offer->addIniVieOffers($request);
    }

    public function updateIniVieOffers(StoreOfferRequest $request, $id){
        return $this->offer->updateIniVieOffers($request, $id);
    }

    public function deleteIniVieOffers($id){
        return $this->offer->deleteIniVieOffers($id);
    }

    public function getPropertyOffersIniVie($slug_property){
        return $this->offer->getPropertyOffersIniVie($slug_property);
    }

    

    

}
