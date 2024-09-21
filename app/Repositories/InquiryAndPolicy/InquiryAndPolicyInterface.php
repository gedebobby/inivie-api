<?php

namespace App\Repositories\InquiryAndPolicy;

interface InquiryAndPolicyInterface {
    public function getIniVieMarketingInquiries();
    public function addIniVieMarketingInquiries($request);
    public function getIniVieSalesInquiries();
    public function addIniVieSalesInquiries($request);
    public function getIniVieJobs();
    public function addIniVieJobs($request);
    public function updateIniVieJobs($request, $hire_id);
    public function getIniVieJobPositions();
    public function addIniVieJobPositions($request);
    public function getIniVieJobForm();
    public function addIniVieJobForm($request);
    public function getHireCandidate($hire_id);
    public function getIniVieSubscribers();
    public function addIniVieSubscribers($request);
}