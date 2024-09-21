<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRoom;
use App\Repositories\RoomList\RoomListInterface;
use Illuminate\Http\Request;

class RoomListController extends Controller
{
    public $room_list;

    public function __construct(RoomListInterface $room_list)
    {
        $this->room_list = $room_list;
    }

    public function index(){
        return $this->room_list->getAllRoomList();
    }

    public function addRoomList(StorePropertyRoom $request){
        return $this->room_list->addRoomList($request);
    }

    public function updateRoomList(StorePropertyRoom $request, $room_id){
        return $this->room_list->updateRoomList($request, $room_id);
    }

    public function deleteRoomList($room_id){
        return $this->room_list->deleteRoomList($room_id);
    }

    public function getPropertyRoomList($slug_property){
        return $this->room_list->getPropertyRoomList($slug_property);
    }

    public function getPropertyRoomListById($slug_property, $room_id){
        return $this->room_list->getPropertyRoomListById($slug_property, $room_id);
    }

    public function addGalleryRoomList(Request $request){
        return $this->room_list->addGalleryRoomList($request);
    }

    public function deletePhotoGalleryRoomList($photo_id){
        return $this->room_list->deletePhotoGalleryRoomList($photo_id);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
