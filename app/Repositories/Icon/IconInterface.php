<?php 

namespace App\Repositories\Icon;

interface IconInterface {
    public function getPropertyIconByType($request);
    public function addPropertyIcon($request);
    public function updatePropertyIcon($request, $icon_id);
    public function deletePropertyIcon($icon_id);
}