<?php

namespace App\Repositories\Property;

interface IniViePropertyInterface {
    public function getIniVieProperty($request);
    public function getIniViePropertyByType();
    public function addIniVieProperty($request);
    public function updateIniVieProperty($request, $id);
    public function deleteIniVieProperty($id);
}