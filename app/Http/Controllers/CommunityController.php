<?php

namespace App\Http\Controllers;

use App\model\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function createCommunity(Request $request){
        $community = new Community();
        $community_create = $community->createCommunity($request->json());
        $response = array(
            'status' => http_response_code(),
            "data" => $community_create['community_details'],
            'message' => $community_create['message']
        );
        return $response;

    }
    public function getCommunityDetails($id){
        $community = new Community();
        $community_details = $community->getCommunityDetails($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $community_details['community_details'],
            'message' => $community_details['message']
        );

        return $response;
    }

    public function updateCommunityPrivacy($id, Request $request){
        $community = new Community();
        $community_update = $community->updateCommunityPrivacy($id, $request);
        $response = array(
            'status' => http_response_code(),
            "data" => $community_update['community_details'],
            'message' => $community_update['message']
        );

        return $response;
    }

    public function updateCommunityViews($id){
        $community = new Community();
        $community_update = $community->updateCommunityViews($id);
        $response = array(
            'status' => http_response_code(),
            "data" => $community_update['community_details']
        );

        return $response;
    }

    public function updateCommunityProfile($id,  Request $request){

        $community = new Community();
        $community_update = $community->updateCommunityProfile($id,$request);
        $response = array(
            'status' => http_response_code(),
            "data" => $community_update['community_details'],
            'message' => $community_update['message']
        );

        return $response;
    }
    public function updateCommunityProfilePic(Request $request){
        $community = new Community();
        $community_update = $community->updateCommunityProfilePic($request);
        $response = array(
            'status' => http_response_code(),
            "data" => $community_update['community_details'],
            'message' => $community_update['message']
        );

        return $response;
    }

    public function updateCommunityCoverPhoto(Request $request){

        $community = new Community();
        $community_update = $community->updateCommunityCoverPhoto($request);
        $response = array(
            'status' => http_response_code(),
            "data" => $community_update['community_details'],
            'message' => $community_update['message']
        );

        return $response;
    }
}

