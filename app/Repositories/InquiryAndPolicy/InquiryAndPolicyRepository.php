<?php

namespace App\Repositories\InquiryAndPolicy;

use App\Models\IniVie\HireModel;
use App\Models\IniVie\JobFormModel;
use App\Models\IniVie\JobPositionModel;
use App\Models\IniVie\MarketingInquiryModel;
use App\Models\IniVie\SalesInquiryModel;
use App\Models\IniVie\SubscriberModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;

class InquiryAndPolicyRepository implements InquiryAndPolicyInterface {

    use ApiResponse, FileUpload;
    public function getIniVieMarketingInquiries(){
        $data = MarketingInquiryModel::all();
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function addIniVieMarketingInquiries($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $file_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie/MarketingInquiries';
                $this->UploadPhoto($file, $file_name, $path_folder);
                $data['file'] = $file_name;
            }
            $stored_data = MarketingInquiryModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function getIniVieSalesInquiries(){
        $data = SalesInquiryModel::all();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addIniVieSalesInquiries($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = SalesInquiryModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function getIniVieJobs(){
        $data = HireModel::with(['property' => function($q){
                    $q->join('ini_vie_property_area', 'list_properties_job.property_area_id', '=', 'ini_vie_property_area.id')
                    ->select('list_properties_job.id','property_name', 'property_area');
                }])->where('status', 1)->get();

        return $this->Success($data, 'Data Retrieved');
    }

    public function addIniVieJobs($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = HireModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updateIniVieJobs($request, $hire_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $hire = HireModel::findOrFail($hire_id);
            $hire->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($hire, 'Data Updated');
    }
    
    public function getIniVieJobPositions(){
        $data = JobPositionModel::all();
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function getIniVieJobPositionById($job_position_id){
        $data = JobPositionModel::find($job_position_id);
        return $this->Success($data, 'Data Retrieved');
    }

    public function addIniVieJobPositions($request){
        $data = $request->only(['job_position']);
        DB::beginTransaction();
        try {
            $stored_data = JobPositionModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function updateIniVieJobPositions($request, $job_position_id){
        $data = $request->only(['job_position']);
        DB::beginTransaction();
        try {
            $job_position = JobPositionModel::find($job_position_id);
            $job_position->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($data, 'Data Updated');  
    }

    public function getIniVieJobForm(){
        $data = JobFormModel::where('status', 1)->get();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addIniVieJobForm($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $file_name = substr(sha1(rand()), 0, 25) . '.' . $ext;
                $path_folder = 'inivie/FormJob';
                $this->UploadPhoto($file, $file_name, $path_folder);
                $data['file'] = $file_name;
            }
            $stored_data = JobFormModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }

    public function getHireCandidate($hire_id){
        $data = JobFormModel::where('hire_id', $hire_id)->get();
        return $this->Success($data, 'Data Retrieved');
    }

    public function getIniVieSubscribers(){
        $data = SubscriberModel::all();
        return $this->Success($data, 'Data Retrieved');
    }

    public function addIniVieSubscribers($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stored_data = SubscriberModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }
        return $this->Success($stored_data, 'Data Added');
    }
}