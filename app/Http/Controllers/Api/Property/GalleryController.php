<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use App\Repositories\Gallery\GalleryInterface;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public $gallery;

    public function __construct(GalleryInterface $gallery){
        $this->gallery = $gallery;
    }

   public function getPropertyGallery($slug_property){
        return $this->gallery->getPropertyGallery($slug_property);
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryModel $galleryModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryModel $galleryModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryModel $galleryModel)
    {
        //
    }
}
