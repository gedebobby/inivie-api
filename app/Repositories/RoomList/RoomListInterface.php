<?php 

namespace App\Repositories\RoomList;

interface RoomListInterface {
    public function getAllRoomList();
    public function addRoomList($request);
    public function updateRoomList($request, $room_id);
    public function deleteRoomList($room_id);
    public function getPropertyRoomList($slug_property);
    public function getPropertyRoomListById($slug_property, $room_id);
    public function addGalleryRoomList($request);
    public function deletePhotoGalleryRoomList($photo_id);
}

?>