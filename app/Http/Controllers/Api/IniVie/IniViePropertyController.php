<?php

namespace App\Http\Controllers\Api\IniVie;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Repositories\Property\IniViePropertyInterface;
use Illuminate\Http\Request;

class IniViePropertyController extends Controller
{
    public $property;

    public function __construct(IniViePropertyInterface $property)
    {
        $this->property = $property;
    }

    public function getIniVieProperty(Request $request){
        return $this->property->getIniVieProperty($request);
    }

    public function getIniViePropertyByType(){
        return $this->property->getIniViePropertyByType();
    }

    public function addIniVieProperty(StorePropertyRequest $request){
        return $this->property->addIniVieProperty($request);
    }

    public function updateIniVieProperty(StorePropertyRequest $request, $id){
        return $this->property->updateIniVieProperty($request, $id);
    }

    public function deleteIniVieProperty($id){
        return $this->property->deleteIniVieProperty($id);
    }
}
