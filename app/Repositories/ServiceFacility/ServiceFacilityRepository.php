<?php 

namespace App\Repositories\ServiceFacility;

use App\Models\FacilitiesListModel;
use App\Models\PropertyServicesModel;
use App\Models\ServicesModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceFacilityRepository implements ServiceFacilityInterface {
    use ApiResponse, FileUpload;

    public function getPropertyServices($slug_property){
        $data = ServicesModel::with(['icon' => function($q){
                    $q->select(['id', 'icon_name', 'icon_image']);
                }])->whereHas('property_services', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->get();
        $data->makeHidden('icon_id');
        return $this->Success($data, 'Data retrieved');
    }

    public function addPropertyServices($request){
        $data = $request->all();
        DB::beginTransaction();
        try {
            PropertyServicesModel::insert($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Saved');
    }

    public function updatePropertyServices($request, $property_id){
        $data = $request->all();
        DB::beginTransaction();
        try {
            PropertyServicesModel::where('list_property_id', $property_id)->delete();
            PropertyServicesModel::insert($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Saved');
    }

    public function getPropertyFacilities($slug_property){
        $data = FacilitiesListModel::whereHas('property', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->get(['id', 'title', 'link', 'description', 'photo']);
        return $this->Success($data, 'Data retrieved');
    }

    public function addPropertyFacilities($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $ext = $photo->getClientOriginalExtension();
                $photo_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $folder_photo = 'inivie_page/FacilityListProperty';
                $this->UploadPhoto($photo, $photo_name, $folder_photo);
                $data['photo'] = $photo_name;
            }
            $stored_data = FacilitiesListModel::create($data);
            // Add Page Facilities pending duls
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($stored_data, 'Data Saved');
    }

    public function updatePropertyFacilities($request, $facility_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $facility = FacilitiesListModel::findOrFail($facility_id);
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $ext = $photo->getClientOriginalExtension();
                $photo_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $folder_photo = 'inivie_page/FacilityListProperty';
                Storage::delete($facility->photo);
                $this->UploadPhoto($photo, $photo_name, $folder_photo);
                $data['photo'] = $photo_name;
            }
            $facility->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Updated');
    }

    public function deletePropertyFacilities($facility_id){
        DB::beginTransaction();
        try {
            $data = FacilitiesListModel::findOrFail($facility_id);
            $data->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Deleted');
    }

    public function getFacilities($request){
        $property_id = $request->property_id;
        $data = FacilitiesListModel::when($property_id, fn ($q) => $q->where('list_property_id', $property_id))->get();
        return $this->Success($data, 'Data Facilities');
    }
}