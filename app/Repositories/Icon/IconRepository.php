<?php

namespace App\Repositories\Icon;

use App\Models\IconModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IconRepository implements IconInterface {
    use ApiResponse, FileUpload;

    public function getPropertyIconByType($request)
    {
        $data = IconModel::where('icon_type', $request->type)->get();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addPropertyIcon($request){
        $data = $request->validated();
        $file = $request->file('icon_image');
        DB::beginTransaction();
        try {
            if ($request->hasFile('icon_image')) {
                $ext = $file->getClientOriginalExtension();
                $filename = $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path = $this->UploadIcon($file, $filename, $data['icon_type']);
                $data['icon_image'] = $path;
                $stored_data = IconModel::create($data);
            }
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyIcon($request, $icon_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $icon = IconModel::findOrFail($icon_id);
            if ($request->hasFile('icon_image')) {
                $file = $request->file('icon_image');
                $ext = $file->getClientOriginalExtension();
                $filename = $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                Storage::delete($icon->icon_image);
                $path = $this->UploadIcon($file, $filename, $data['icon_type']);
                $data['icon_image'] = $path;
            }
            $icon->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($icon, 'Data Updated');
    }

    public function deletePropertyIcon($icon_id){
        DB::beginTransaction();
        try {
            $icon = IconModel::findOrFail($icon_id);
            Storage::delete($icon->icon_image);
            $icon->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($icon, 'Data Deleted');
    }
}