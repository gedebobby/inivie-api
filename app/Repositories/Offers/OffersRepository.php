<?php

namespace App\Repositories\Offers;

use App\Models\ListPropertyModel;
use App\Models\OffersModel;
use App\Models\OffersVillaModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OffersRepository implements OffersInterface {
    use ApiResponse, FileUpload;

    public function getOffersVilla($request){
        $property_id = $request->property_id;
        $data = OffersVillaModel::when($property_id, fn ($q) => $q->where('list_property_id', $property_id))->get();
        return $this->Success($data, 'Data retrieved');
    }

    public function getPropertyOffersVilla($slug_property){
        $data = OffersVillaModel::whereHas('property', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->get();
        $data->makeHidden(['list_property_id']);
        return $this->Success($data, 'Data retrieved');
    }

    public function addPropertyOffersVilla($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = OffersVillaModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyOffersVilla($request, $offer_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            OffersVillaModel::where('id', $offer_id)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Updated');
    }

    public function deletePropertyOffersVilla($offer_id){
        DB::beginTransaction();
        try {
            $data = OffersVillaModel::findOrFail($offer_id);
            $data->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Deleted');
    }

    public function getIniVieOffers(){
        $data = OffersModel::all();
        return $this->Success($data, 'Dataa');
    }

    public function getIniVieOffersById($id){
        $data = OffersModel::findOrFail($id);
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function getPropertiesIniVieOffer($offer_id){
        $data = OffersModel::with('property')
                ->where('id', $offer_id)
                ->where('status', 1)
                ->get();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addIniVieOffers($request){
        $data = $request->validated();
        $data['offer_slug'] = $data['title'];
        DB::beginTransaction();
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie/Offers';
                $this->UploadPhoto($file, $filename, $path_folder);
                $data['photo'] = $filename;
            }
            $store_data = OffersModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($store_data, 'Data Saved');
    }

    public function updateIniVieOffers($request, $id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $offer = OffersModel::findOrFail($id);
            $data['offer_slug'] = $data['title'];
            $offer->offer_slug = $data['title'];
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie/Offers';
                Storage::delete($offer->photo);
                $this->UploadPhoto($file, $filename, $path_folder);
                $data['photo'] = $filename;
            }
            $offer->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        } 
        return $this->Success($offer, 'Data Updated');
    }
    
    public function deleteIniVieOffers($id){
        DB::beginTransaction();
        try {
            $offer = OffersModel::findOrFail($id);
            $offer->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        } 
        return $this->Success($offer, 'Data Deleted');
    }

    public function getPropertyOffersIniVie($slug_property){
        $data = DB::table('offers')
                ->join('property_offer', 'offers.id', 'property_offer.offer_id')
                ->join('list_properties', 'list_property_id', 'list_properties.id')
                ->where('slug', '=', $slug_property)
                // ->select('title', 'offer_slug', 'slug', 'description', 'booking_link', 'property_offer.promo_code', 'photo')
                ->get();

        // $data = OffersModel::with('property_offer:promo_code')->whereHas('property', function($q) use($slug_property){
        //             $q->where('slug', $slug_property);
        //         })->get();
        return $this->Success($data, 'Datas');
    }

}