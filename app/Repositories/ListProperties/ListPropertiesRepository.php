<?php

namespace App\Repositories\ListProperties;

use App\Http\Resources\PropertyDetailResource;
use App\Models\ActivitiesModel;
use App\Models\AwardsModel;
use App\Models\ContactModel;
use App\Models\FacilitiesListModel;
use App\Models\ListPropertyDetailModel;
use App\Models\ListPropertyModel;
use App\Models\MetaVideoModel;
use App\Models\OffersVillaModel;
use App\Models\PageFacilitiesModel;
use App\Models\PagePopupsModel;
use App\Models\PropertyThemeModel;
use App\Models\ServicesModel;
use App\Models\SurprisesModel;
use App\Models\TestimonialModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListPropertiesRepository implements ListPropertiesInterface {

    use ApiResponse, FileUpload;
    public function getAllListProperties()
    {
        $data = ListPropertyModel::all();
        return $this->Success($data, 'Data retrieved');
    }

    public function getPropertyDetail($slug_property){
        $data = ListPropertyModel::with([
                'property_services' => function($q){
                    $q->join('icon', 'services.icon_id', '=', 'icon.id')
                        ->select('services.name', 'icon.icon_image')
                        // ->distinct()
                        ;
                },
                'property_detail',
                'contact',
                'surprises',
                'meta_video',
                'theme_color',
                'awards',
                'popup',
                'testimonials',
                ])->where('slug', $slug_property)->first();
        return $this->Success($data, 'Data retrieved');
    }

    public function addPropertyDetail($request){
        $data = $request->validated();
        // if (ListPropertyDetailModel::where('list_property_id', $data['list_property_id'])->exists()) {
        //     return $this->Error('Detail Property Sudah Ada', 201);
        // }
        DB::beginTransaction();
        try {
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $ext = $logo->getClientOriginalExtension();
                $logo_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $folder_logo = 'inivie_page/LogoProperty';
                $this->UploadPhoto($logo, $logo_name, $folder_logo);
            }
            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $ext = $favicon->getClientOriginalExtension();
                $favicon_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $folder_favicon = 'inivie_page/FaviconProperty';
                $this->UploadPhoto($favicon, $favicon_name, $folder_favicon);
            }
            $data['logo'] = $logo_name;
            $data['favicon'] = $favicon_name;
            $stored_data = ListPropertyDetailModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added', 201);
    }

    public function updatePropertyDetail($request, $property_detail_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $property_detail = ListPropertyDetailModel::findOrFail($property_detail_id);
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $ext = $logo->getClientOriginalExtension();
                $logo_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $folder_logo = 'inivie_page/LogoProperty';
                Storage::delete($property_detail->logo);
                $this->UploadPhoto($logo, $logo_name, $folder_logo);
                $data['logo'] = $logo_name;
            }
            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $ext = $favicon->getClientOriginalExtension();
                $favicon_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $folder_favicon = 'inivie_page/FaviconProperty';
                $this->UploadPhoto($favicon, $favicon_name, $folder_favicon);
                Storage::delete($property_detail->favicon);
                $data['favicon'] = $favicon_name;
            }
            $property_detail->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($property_detail, 'Data Updated');
    }
    
    public function getPropertyContact($slug_property){
        $data = ContactModel::whereHas('property', function($q) use($slug_property){
                    $q->where('slug', $slug_property);
                })->first();
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function addPropertyContact($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = ContactModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyContact($request, $contact_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $contact = ContactModel::findOrFail($contact_id);
            $contact->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($contact, 'Data Added');
    }

    public function getPropertyPageFacilities($slug_property, $slug_facility){
        $data = FacilitiesListModel::with('page_facilities')
                ->whereHas('property', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->whereHas('page_facilities', function($query) use($slug_facility){
                    $query->where('slug', $slug_facility);
                })->get();
        $data->makeHidden(['id', 'title', 'link', 'description', 'list_property_id', 'photo']);
        return $this->Success($data, 'Data retrieved');
    }
    
    public function getPropertySurprise($slug_property){
        $data = SurprisesModel::whereHas('property', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->get();
        $data->makeHidden(['list_property_id']);
        return $this->Success($data, 'Data retrieved');
    }
    
    public function addPropertySurprise($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = SurprisesModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertySurprise($request, $surprise_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = SurprisesModel::where('id', $surprise_id)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Updated');
    }

    public function deletePropertySurprise($surprise_id){
        DB::beginTransaction();
        try {
            $data = SurprisesModel::findOrFail($surprise_id);
            $data->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Deleted');
    }

    public function getPropertyTestimonials($slug_property){
        $data = TestimonialModel::whereHas('property', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->get();
        $data->makeHidden(['list_property_id']);
        return $this->Success($data, 'Data retrieved');
    }

    public function addPropertyTestimonials($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = TestimonialModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyTestimonials($request, $testimonial_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = TestimonialModel::where('id', $testimonial_id)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Updated');
    }
    
    public function deletePropertyTestimonials($testimonial_id){
        DB::beginTransaction();
        try {
            $data = TestimonialModel::findOrFail($testimonial_id);
            $data->delete();
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Deleted');
    }

    public function getPropertyPopup($slug_property){
        $data = PagePopupsModel::whereHas('property', function($query) use($slug_property){
                    $query->where('slug', $slug_property);
                })->get();
        $data->makeHidden(['list_property_id']);
        return $this->Success($data, 'Data retrieved');
    }

    public function getPropertyMetaVideo($slug_property){
        $data = MetaVideoModel::whereHas('property', function($q) use($slug_property){
                    $q->where('slug', $slug_property);
                })->get();
        return $this->Success($data, 'Data retrieved');
    }

    public function addPropertyMetaVideo($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $ext = $video->getClientOriginalExtension();
                $video_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/VideoProperty';
                $this->UploadPhoto($video, $video_name, $path_folder);
                $data['video'] = $video_name;
            }
            $stored_data = MetaVideoModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyMetaVideo($request, $meta_video_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $metavideo = MetaVideoModel::findOrFail($meta_video_id);
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $ext = $video->getClientOriginalExtension();
                $video_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/VideoProperty';
                Storage::delete($metavideo->video);
                $this->UploadPhoto($video, $video_name, $path_folder);
                $data['video'] = $video_name;
            }
            $metavideo->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($metavideo, 'Data Updated');
    }
    
    public function getPropertyTheme($slug_property) {
        $data = PropertyThemeModel::whereHas('property', function($q) use($slug_property){
                    $q->where('slug', $slug_property);
                })->first();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addPropertyTheme($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = PropertyThemeModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyTheme($request, $theme_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $theme = PropertyThemeModel::findOrFail($theme_id);
            $theme->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($theme, 'Data Updated');
    }

    public function getPropertyAward($slug_property){
        $data = AwardsModel::whereHas('property', function($q) use($slug_property){
                    $q->where('slug', $slug_property);
                })->get();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addPropertyAward($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $image_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/awards';
                $this->UploadPhoto($image, $image_name, $path_folder);
                $data['image'] = $image_name;
            }
            $stored_data = AwardsModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyAward($request, $award_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $award = AwardsModel::findOrFail($award_id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $image_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/awards';
                Storage::delete($award->image);
                $this->UploadPhoto($image, $image_name, $path_folder);
                $data['image'] = $image_name;
            }
            $award->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($award, 'Data Updated');
    }

    public function deletePropertyAward($award_id){
        DB::beginTransaction();
        try {
            $award = AwardsModel::findOrFail($award_id);
            if ($award) {
                Storage::delete($award->image);
                $award->delete();
            } 
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($award, 'Data Deleted');
    }

    public function getPropertyActivities($slug_property){
        $data = ActivitiesModel::whereHas('property', function($q) use($slug_property){
            $q->where('slug', $slug_property);
        })->get();
        return $this->Success($data, 'Data Retrieved');
    }

    public function getPropertyActivitiesById($activity_id){
        $data = ActivitiesModel::findOrFail($activity_id);
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function addPropertyActivities($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $ext = $photo->getClientOriginalExtension();
                $photo_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/activities';
                $this->UploadPhoto($photo, $photo_name, $path_folder);
                $data['photo'] = $photo_name;
            }
            $stored_data = ActivitiesModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updatePropertyActivities($request, $activity_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $activity = ActivitiesModel::findOrFail($activity_id);
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $ext = $photo->getClientOriginalExtension();
                $photo_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie_page/activities';
                Storage::delete($activity->photo);
                $this->UploadPhoto($photo, $photo_name, $path_folder);
                $data['photo'] = $photo_name;
            }
            $activity->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Added');
    }

    public function deletePropertyActivities($activity_id){
        DB::beginTransaction();
        try {
            $activity = ActivitiesModel::findOrFail($activity_id);
            $activity->delete();
            if ($activity) {
                Storage::delete($activity->photo);
            } 
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($activity, 'Data Deleted');
    }
}

?>