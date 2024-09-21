<?php

namespace App\Http\Controllers\Api\IniVie;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHireRequest;
use App\Http\Requests\StoreJobFormRequest;
use App\Http\Requests\StoreMarketingInquiryRequest;
use App\Http\Requests\StoreSalesInquiryRequest;
use App\Http\Requests\StoreSubscriberRequest;
use App\Repositories\InquiryAndPolicy\InquiryAndPolicyInterface;
use Illuminate\Http\Request;

class InquiryAndPolicyController extends Controller
{
    public $inquiry_policy;

    public function __construct(InquiryAndPolicyInterface $inquiry_policy)
    {
        $this->inquiry_policy = $inquiry_policy;
    }

    public function getIniVieMarketingInquiries(){
        return $this->inquiry_policy->getIniVieMarketingInquiries();
    }    

    public function addIniVieMarketingInquiries(StoreMarketingInquiryRequest $request){
        return $this->inquiry_policy->addIniVieMarketingInquiries($request);
    }

    public function getIniVieSalesInquiries(){
        return $this->inquiry_policy->getIniVieSalesInquiries();
    }    

    public function addIniVieSalesInquiries(StoreSalesInquiryRequest $request){
        return $this->inquiry_policy->addIniVieSalesInquiries($request);
    }

    public function getIniVieJobs(){
        return $this->inquiry_policy->getIniVieJobs();
    }

    public function addIniVieJobs(StoreHireRequest $request){
        return $this->inquiry_policy->addIniVieJobs($request);
    }

    public function updateIniVieJobs(StoreHireRequest $request, $hire_id){
        return $this->inquiry_policy->updateIniVieJobs($request, $hire_id);
    }
    
    public function getIniVieJobPositions(){
        return $this->inquiry_policy->getIniVieJobPositions();
    }
    
    public function addIniVieJobPositions(Request $request){
        return $this->inquiry_policy->addIniVieJobPositions($request);
    }
    
    public function getIniVieJobForm(){
        return $this->inquiry_policy->getIniVieJobForm();
    }

    public function addIniVieJobForm(StoreJobFormRequest $request){
        return $this->inquiry_policy->addIniVieJobForm($request);
    }

    public function getHireCandidate($hire_id){
        return $this->inquiry_policy->getHireCandidate($hire_id);
    }

    public function getIniVieSubscribers(){
        return $this->inquiry_policy->getIniVieSubscribers();
    }

    public function addIniVieSubscribers(StoreSubscriberRequest $request){
        return $this->inquiry_policy->addIniVieSubscribers($request);
    }
    

}
