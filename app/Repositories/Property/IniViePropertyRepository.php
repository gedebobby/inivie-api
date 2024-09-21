<?php

namespace App\Repositories\Property;

use App\Models\IniVie\PropertyModel;
use App\Models\IniVie\PropertyTypeModel;
use App\Models\ListPropertyModel;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class IniViePropertyRepository implements IniViePropertyInterface {
    use ApiResponse;
    
    public function getIniVieProperty($request){
        $data = PropertyModel::join('ini_vie_property_type', 'ini_vie_properties.property_type_id', 'ini_vie_property_type.id')
                ->join('ini_vie_property_area', 'ini_vie_properties.property_area_id', 'ini_vie_property_area.id')
                ->when($request->property_area_id, fn ($q) => $q->where('property_area_id', $request->property_area_id))
                ->when($request->property_type_id, fn ($q) => $q->where('property_type_id', $request->property_type_id))
                ->where('status', 1)
                ->get();
        // $data->makeHidden(['property_area_id', 'property_type_id']);
        return $this->Success($data, 'Data');
    }

    public function getIniViePropertyByType(){
        $data = PropertyTypeModel::with(['property' => function($q){
                    $q->join('ordering_properties', 'ini_vie_properties.id', '=', 'ordering_properties.property_id')->orderBy('number_of_list', 'asc');
                }])->get();
        return $this->Success($data, 'Data');
    }

    public function addIniVieProperty($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $store_data = PropertyModel::create($data);         
            ListPropertyModel::create([
                "name" => $request->name,
                "slug" => $request->slug,
                "active" => $request->active,
                "property_id" => $store_data->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }        
        return $this->Success($data, 'Post Success');
    }

    public function updateIniVieProperty($request, $id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            PropertyModel::where('id', $id)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Update Success');
    }

    public function deleteIniVieProperty($id){
        DB::beginTransaction();
        try {
            $inivieprop = PropertyModel::findOrFail($id);
            $inivieprop->status = 0;
            $inivieprop->update();
            ListPropertyModel::where('property_id', $id)->update(["status" => 0]);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($inivieprop, 'Update Success');
    }
}