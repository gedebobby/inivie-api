<?php

use App\Http\Controllers\Api\IniVie\IniViePropertyController;
use App\Http\Controllers\Api\IniVie\InquiryAndPolicyController;
use App\Http\Controllers\Api\Property\AlbumController;
use App\Http\Controllers\Api\Property\IconController;
use App\Http\Controllers\api\Property\OffersController;
use App\Http\Controllers\Api\Property\ListPropertyController;
use App\Http\Controllers\Api\Property\PhotoController;
use App\Http\Controllers\Api\Property\RoomListController;
use App\Http\Controllers\Api\Property\ServiceFacilityController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::group(['middleware' => 'auth:sanctum'],function(){
    // Route::get('user',[AuthController::class,'user']);

    // INI VIE
    // --Property--
    Route::get('inivie/properties',[IniViePropertyController::class,'getIniVieProperty']); // Get Inivie Properties //
    Route::get('inivie/area/properties',[IniViePropertyController::class,'getIniViePropertyByType']); // Get Inivie Properties by type //
    Route::post('inivie/properties',[IniViePropertyController::class,'addIniVieProperty']); // Add Inivie Properties //
    Route::post('inivie/properties/{id}',[IniViePropertyController::class,'updateIniVieProperty']); // Update Inivie Properties //
    Route::delete('inivie/properties/{id}',[IniViePropertyController::class,'deleteIniVieProperty']); // Delete Inivie Properties //
    
    // --offer-
    Route::get('inivie/offers',[OffersController::class,'getIniVieOffers']); // Get Inivie Offer //
    Route::get('inivie/offers/{id}',[OffersController::class,'getIniVieOffersById']); // Get Inivie Offer By ID//
    Route::get('inivie/offers/{id}/properties',[OffersController::class,'getPropertiesIniVieOffer']); // Get Properties Inivie Offer By ID//
    Route::post('inivie/offers',[OffersController::class,'addIniVieOffers']); // Add Inivie Offer //
    Route::post('inivie/offers/{id}',[OffersController::class,'updateIniVieOffers']); // Update Inivie Offer //
    Route::delete('inivie/offers/{id}',[OffersController::class,'deleteIniVieOffers']); // Update Inivie Offer //
    
    // --Marketing & Inquiries-- 
    Route::get('inivie/marketing-inquiries',[InquiryAndPolicyController::class,'getIniVieMarketingInquiries']); // Get Marketing Inquiries //
    Route::post('inivie/marketing-inquiries',[InquiryAndPolicyController::class,'addIniVieMarketingInquiries']); // Add Marketing Inquiries //
    
    // --Sales & Inquiries-- 
    Route::get('inivie/sales-inquiries',[InquiryAndPolicyController::class,'getIniVieSalesInquiries']); // Get Marketing Inquiries //
    Route::post('inivie/sales-inquiries',[InquiryAndPolicyController::class,'addIniVieSalesInquiries']); // Add Marketing Inquiries //
    
    // --Jobs-
    Route::get('inivie/jobs',[InquiryAndPolicyController::class,'getIniVieJobs']); // Get Ini Vie Jobs //
    Route::post('inivie/jobs',[InquiryAndPolicyController::class,'addIniVieJobs']); // Add Ini Vie Jobs //
    Route::post('inivie/jobs/{hire_id}',[InquiryAndPolicyController::class,'updateIniVieJobs']); // Update Ini Vie Jobs //
    Route::get('inivie/job-positions',[InquiryAndPolicyController::class,'getIniVieJobPositions']); // Get Ini Vie Job Positions //
    Route::post('inivie/job-positions',[InquiryAndPolicyController::class,'addIniVieJobPositions']); // Add Ini Vie Job Positions //
    Route::get('inivie/job-positions/{job_position_id}',[InquiryAndPolicyController::class,'getIniVieJobPositionById']); // Add Ini Vie Job Positions //
    Route::post('inivie/job-positions/{job_position_id}',[InquiryAndPolicyController::class,'updateIniVieJobPositions']); // Add Ini Vie Job Positions //

    Route::get('inivie/job-form',[InquiryAndPolicyController::class,'getIniVieJobForm']); // Get Ini Vie Job Form (all candidate) //
    Route::post('inivie/job-form',[InquiryAndPolicyController::class,'addIniVieJobForm']); // add Ini Vie Job Form//
    Route::get('inivie/candidate/{hire_id}',[InquiryAndPolicyController::class,'getHireCandidate']); // Get Ini Vie Hire Candidate //
    
    // Subscribe
    Route::get('inivie/subscribers',[InquiryAndPolicyController::class,'getIniVieSubscribers']); // Get Ini Vie Subscribers //
    Route::post('inivie/subscribers',[InquiryAndPolicyController::class,'addIniVieSubscribers']); // Add Ini Vie Subscribers //
    
    // --master data property--
    // ICON
    Route::get('property/icons',[IconController::class,'getPropertyIconByType']); // Get Property Icon by Type //
    Route::post('property/icons',[IconController::class,'addPropertyIcon']); // Add Property Icon //
    Route::post('property/icons/{icon_id}',[IconController::class,'updatePropertyIcon']); // Update Property Icon //
    Route::delete('property/icons/{icon_id}',[IconController::class,'deletePropertyIcon']); // Delete Property Icon //
    
    // PROPERTY WEB THEME
    Route::get('property/{slug_property}/theme',[ListPropertyController::class,'getPropertyTheme']); // Get Property Theme //
    Route::post('property/theme',[ListPropertyController::class,'addPropertyTheme']); // Add Property Theme //
    Route::post('property/theme/{theme_id}',[ListPropertyController::class,'addPropertyTheme']); // Update Property Theme //
    
    // PROPERTY ACTIVITIES
    Route::get('property/{slug_property}/activities',[ListPropertyController::class,'getPropertyActivities']); // Get Activities Property
    Route::get('property/activities/{activity_id}',[ListPropertyController::class,'getPropertyActivitiesById']); // Get Activities Property By Id
    Route::post('property/activities',[ListPropertyController::class,'addPropertyActivities']); // Add Activities Property
    Route::post('property/activities/{activity_id}',[ListPropertyController::class, 'updatePropertyActivities']); // Update Activities Property
    Route::delete('property/activities/{activity_id}',[ListPropertyController::class, 'deletePropertyActivities']); // Delete Activities Property

    // PROPERTY //
    Route::get('property/{slug_property}/detail',[ListPropertyController::class,'getPropertyDetail']); // Get Detail Property (metatag, contact, deskripsi)
    Route::post('property/detail',[ListPropertyController::class,'addPropertyDetail']); // Add Detail Property (metatag, contact, deskripsi)
    Route::post('property/detail/{detail_property_id}',[ListPropertyController::class,'updatePropertyDetail']); // Add Detail Property (metatag, contact, deskripsi)
    
    // PROPERTY META VIDEO
    Route::get('property/{slug_property}/metavideo',[ListPropertyController::class,'getPropertyMetaVideo']); // Get Property Meta Video
    Route::post('property/metavideo',[ListPropertyController::class,'addPropertyMetaVideo']); // Add Property Meta Video
    Route::post('property/metavideo/{meta_video_id}',[ListPropertyController::class,'updatePropertyMetaVideo']); // Update Property Meta Video

    // PROPERTY AWARD
    Route::get('property/{slug_property}/award',[ListPropertyController::class,'getPropertyAward']); // Get Property Award
    Route::post('property/award',[ListPropertyController::class,'addPropertyAward']); // Add Property Award
    Route::post('property/award/{award_id}',[ListPropertyController::class,'updatePropertyAward']); // Update Property Award
    Route::delete('property/award/{award_id}',[ListPropertyController::class,'deletePropertyAward']); // Delete Property Award

    // PROPERTY CONTACT
    Route::get('property/{slug_property}/contact',[ListPropertyController::class,'getPropertyContact']); // Add Property Contact
    Route::post('property/contact',[ListPropertyController::class,'addPropertyContact']); // Add Property Contact
    Route::post('property/contact/{contact_id}',[ListPropertyController::class,'updatePropertyContact']); // Add Property Contact
    // Route::delete('property/detail',[ListPropertyController::class,'addPropertyDetail']); // Add Detail Property (metatag, contact, deskripsi)
   
    // PROPERTY SERVICE
    Route::get('property/{slug_property}/services',[ServiceFacilityController::class,'getPropertyServices']); // Get Property Services
    Route::post('property/services',[ServiceFacilityController::class,'addPropertyServices']); // Add Property Services
    Route::post('property/services/{property_id}',[ServiceFacilityController::class,'updatePropertyServices']); // Update Property Services

    // PROPERTY ROOMS
    Route::get('/property/{slug_property}/room',[RoomListController::class,'getPropertyRoomList']); // get property room list
    Route::get('/property/{slug_property}/room/{room_id}',[RoomListController::class,'getPropertyRoomListById']); // get property room list by slug
    Route::post('/property/room',[RoomListController::class,'addRoomList']); // add property room list with facilities
    Route::post('/property/room/{room_id}', [RoomListController::class,'updateRoomList']); // update property room list
    Route::delete('/property/room/{room_id}', [RoomListController::class,'deleteRoomList']); // Delete property room list
    Route::post('/property/gallery/room', [RoomListController::class,'addGalleryRoomList']); // add photo gallery property room list
    Route::delete('/property/gallery/room/{room_id}', [RoomListController::class,'deletePhotoGalleryRoomList']); // delete photo gallery property room list

    // PROPERTY FACILITIES
    Route::get('property/facilities',[ServiceFacilityController::class,'getFacilities']); // Get Facilities
    Route::get('property/{slug_property}/facilities',[ServiceFacilityController::class,'getPropertyFacilities']); // Get Property Facilities
    Route::post('property/facilities',[ServiceFacilityController::class,'addPropertyFacilities']); // Add Property Facilities
    Route::post('property/facilities/{facility_id}',[ServiceFacilityController::class,'updatePropertyFacilities']); // Update Property Facilities
    Route::delete('property/facilities/{facility_id}',[ServiceFacilityController::class,'deletePropertyFacilities']); // Delete Property Facilities
    Route::get('property/{slug_property}/facilities/{slug_facility}',[ListPropertyController::class,'getPropertyPageFacilities']); // Property Facilities

    // PROPERTY TESTIMONIALS
    Route::get('property/{slug_property}/testimonials',[ListPropertyController::class,'getPropertyTestimonials']); // Get Property Testimonials
    Route::post('property/testimonials',[ListPropertyController::class,'addPropertyTestimonials']); // Add Property Testimonials
    Route::post('property/testimonials/{testimonial_id}',[ListPropertyController::class,'updatePropertyTestimonials']); // Add Property Testimonials
    Route::delete('property/testimonials/{testimonial_id}',[ListPropertyController::class,'deletePropertyTestimonials']); // Add Property Testimonials
    
    // PROPERTY SURPRISES
    Route::get('property/{slug_property}/surprises',[ListPropertyController::class,'getPropertySurprise']); // Get Property Surprises
    Route::post('property/surprises',[ListPropertyController::class,'addPropertySurprise']); // Add Property Surprises
    Route::post('property/surprises/{surprise_id}',[ListPropertyController::class,'updatePropertySurprise']); // Update Property Surprises
    Route::delete('property/surprises/{surprise_id}',[ListPropertyController::class,'deletePropertySurprise']); // Delete Property Surprises
    
    // PROPERTY OFFERS
    Route::get('property/offers',[OffersController::class,'getOffersVilla']); // Get Property Offers
    Route::get('property/{slug_property}/offers',[OffersController::class,'getPropertyOffersVilla']); // Get Property Offers
    Route::post('property/offers',[OffersController::class,'addPropertyOffersVilla']); // Add Property Offers
    Route::post('property/offers/{offer_id}',[OffersController::class,'updatePropertyOffersVilla']); // Update Property Offers
    Route::delete('property/offers/{offer_id}',[OffersController::class,'deletePropertyOffersVilla']); // Delete Property Offers

    Route::get('property/{slug_property}/ini-vie-offers',[OffersController::class,'getPropertyOffersIniVie']); // Ini vie Offers
    Route::get('property/{slug_property}/popup',[ListPropertyController::class,'getPropertyPopup']); // page_popup

    // GALLERY | ALBUM | PHOTOS 
    Route::get('/property/{slug_property}/gallery',[PhotoController::class,'getPropertyPhotos']); // Get Property All Photos
    Route::get('/property/{slug_property}/album',[AlbumController::class,'getPropertyAlbum']); // Get Property List Album
    Route::post('/property/photo/{album_id}',[PhotoController::class,'addPropertyPhotos']); // Add Property Photos to Album
    Route::post('/property/album',[AlbumController::class,'addPropertyAlbum']); // Add Property Album
    Route::post('/property/album/{album_id}',[AlbumController::class,'updatePropertyAlbum']); // Update Property Album
    Route::delete('/property/album/{album_id}',[AlbumController::class,'deletePropertyAlbum']); // delete Property Album
    Route::get('/property/{slug_property}/album/{id}',[AlbumController::class,'getSpecificPropertyAlbum']); // Property Photo from Specific Album
   
    // Route::get('logout',[AuthController::class,'logout']);

    

// }); 

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
