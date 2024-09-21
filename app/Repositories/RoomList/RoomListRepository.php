<?php

namespace App\Repositories\RoomList;

use App\Models\GalleryModel;
use App\Models\RoomFacilitiesDetail;
use App\Models\RoomListModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomListRepository implements RoomListInterface {

    use ApiResponse, FileUpload;
    public function getAllRoomList()
    {
        $data = RoomListModel::with(['facilities', 'property'])->where('is_active', "1")->get();
        return $this->Success($data, 'Success');
    }

    public function addRoomList($request){
        $data = $request->validated();
        $file = $request->file('photo');
        $data['slug'] = $data['title'];
        $path = "";
        DB::beginTransaction();
        try {
            $stored_data = RoomListModel::create($data);
            if ($request->hasFile('photo')) {
                $ext = $file->getClientOriginalExtension();
                $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/RoomProperty'; 
                $path = $this->UploadPhoto($file, $filename, $path_folder);
            }
            $stored_data->photo = $filename;
            $stored_data->save();

            if($request->facilities){
                $facilities = $request->facilities;
                foreach ($facilities as $facilities) {
                    $facilities_[] = array(
                        'room_list_id' => $stored_data->id,
                        'facilities_room_id' => $facilities['facilities_room_id'],
                    );
                }
                $stored_data->facilities = $facilities_;
                RoomFacilitiesDetail::insert($facilities_);
            }
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($stored_data, 'Data Added');
    }

    public function updateRoomList($request, $room_id){
        $data = $request->validated();
        $data['slug'] = $data['title'];
        DB::beginTransaction();
        try {
            $roomlist = RoomListModel::findOrFail($room_id);
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/RoomProperty';
                Storage::delete($roomlist->photo);
                $path = $this->UploadPhoto($file, $filename, $path_folder);
                $data['photo'] = $filename;
            }
            $roomlist->update($data);  
            if($request->facilities){
                RoomFacilitiesDetail::where('room_list_id',$room_id)->delete();
                $facilities = $request->facilities;
                foreach ($facilities as $facilities) {
                    $facilities_[] = array(
                        'room_list_id' => $roomlist->id,
                        'facilities_room_id' => $facilities['facilities_room_id'],
                    );
                }
                $roomlist->facilities = $facilities_;
                RoomFacilitiesDetail::insert($facilities_);
            }
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($roomlist, 'Data Updated');
    }

    public function deleteRoomList($room_id){
        $roomlist = RoomListModel::findOrFail($room_id);
        DB::beginTransaction();
        try {
            $roomlist->is_active = 0;
            $roomlist->save();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($roomlist, 'Data Inactivated');
    }

    public function getPropertyRoomList($slug_property){
        // $data = RoomListModel::with(['facilities' => function($query){
        //     $query->with(['icon' => function($q){ $q->select('id', 'icon_name', 'icon_image'); }]);
        // }])->whereHas('property', function($query) use ($slug_property){
        //     $query->where('slug', $slug_property);
        // })->where('is_active', 1)->get();
        
        $data = RoomListModel::whereHas('property', function($query) use ($slug_property){
                    $query->where('slug', $slug_property);
                })->where('is_active', 1)->get();
        return $this->Success($data, 'Success');
    }

    public function getPropertyRoomListById($slug_property, $room_id){
        $data = RoomListModel::with(['facilities' => function($query){
                    $query->with('icon');
                }, 'gallery'])->where('id', $room_id)->get();
        return $this->Success($data, 'Success');
    }

    public function addGalleryRoomList($request){
        if ($request->hasfile('photo')) {
            $files = $request->file('photo');
            $allowedExt = ['jpg', 'png', 'jpeg', 'webp'];
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();
                $check = in_array($ext, $allowedExt);
                if ($check) {
                    $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                    $path_folder = 'inivie_page/RoomProperty';
                    $path = $this->UploadPhoto($file, $filename, $path_folder);
                    $photo = new GalleryModel();
                    $photo->image = $filename;
                    $photo->room_list_id = $request->room_list_id;
                    $photo->save();
                } else {
                    return $this->Error('File must be image', 422);
                }
            }
            return $this->Success('', 'Data Saved');
        } else {
            return $this->Error('No Image', 422);
        }
    }

    public function deletePhotoGalleryRoomList($photo_id){
        DB::beginTransaction();
        try {
            $photo = GalleryModel::findOrFail($photo_id);
            Storage::delete($photo->image);
            $photo->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($photo, 'Data Inactivated');
    }
}

?>