<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyIconRequest;
use App\Repositories\Icon\IconInterface;
use Illuminate\Http\Request;

class IconController extends Controller
{

    public $icon;

    public function __construct(IconInterface $icon)
    {
        $this->icon = $icon;
    }

    public function getPropertyIconByType(Request $request){
        return $this->icon->getPropertyIconByType($request);
    }

    public function addPropertyIcon(StorePropertyIconRequest $request){
        return $this->icon->addPropertyIcon($request);  
    }

    public function updatePropertyIcon(StorePropertyIconRequest $request, $icon_id){
        return $this->icon->updatePropertyIcon($request, $icon_id);
    }

    public function deletePropertyIcon($icon_id){
        return $this->icon->deletePropertyIcon($icon_id);
    }
}
