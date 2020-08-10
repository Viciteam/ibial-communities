<?php

namespace App\Http\Controllers;

use App\model\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function createBusiness(Request $request){
        $business = new Business();
        $business_create = $business->createBusiness($request->json());
        $response = array(
            'status' => http_response_code(),
            "data" => $business['business_details'],
            'message' => $business['message']
        );
        return $response;

    }
    public function getBusinessDetails($id){
        $business = new Business();
        $business_details = $business->getBusinessDetails($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $business_details['business_details'],
            'message' => $business_details['message']
        );

        return $response;
    }

    public function updateBusinessPrivacy($id, Request $request){
        $business = new Business();
        $business_update = $business->updateBusinessPrivacy($id, $request);
        $response = array(
            'status' => http_response_code(),
            "data" => $business_update['business_details'],
            'message' => $business_update['message']
        );

        return $response;
    }

    public function updateBusinessViews($id){
        $business = new Business();
        $business_update = $business->updateBusinessViews($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $business_update['business_details']
        );

        return $response;
    }

    public function updateBusinessProfile($id,  Request $request){

        $business = new Business();
        $business_update = $business->updateBusinessProfile($id,$request);
        $response = array(
            'status' => http_response_code(),
            "data" => $business_update['business_details'],
            'message' => $business_update['message']
        );

        return $response;
    }
    public function updateBusinessProfilePic(Request $request){
        $business = new Business();
        $business_update = $business->updateBusinessProfilePic($request);
        $response = array(
            'status' => http_response_code(),
            "data" => $business_update['business_details'],
            'message' => $business_update['message']
        );

        return $response;
    }

    public function updateBusinessCoverPhoto(Request $request){

        $business = new Business();
        $business_update = $business->updateBusinessCoverPhoto($request);
        $response = array(
            'status' => http_response_code(),
            "data" => $business_update['business_details'],
            'message' => $business_update['message']
        );

        return $response;
    }
}
