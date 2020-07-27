<?php

namespace App\model;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';
    protected $fillable = [
        'name', 'is_private', 'is_visible','status_id','views','created_by'
    ];

    public function getCommunityDetails($community_id){

        $community_details = Community::select('*')
            ->where('id','=',(int)$community_id)
            ->exists();
        if($community_details){
            $community_details = Community::select('*')
                ->where('id','=',(int)$community_id)
                ->first();
            $res = array(
                'community_details' => $community_details,
                'message'=> 'Success'
            );

        }else{
            $res = array(
                'community_details' => "",
                'message'=> 'Error. Community not found'
            );
        }

        return $res;
    }

    public function createCommunity($data){
        $exists = Community::select('*')
            ->where('name','=',$data->get('name'))
            ->exists();
        if($exists){
            $res = array(
                'community_details' => "",
                'message'=> 'Error. Community name is already taken'
            );
        }else{
            $create_community = Community::create([
                'name' => $data->get('name'),
                'is_private' => $data->get('is_private'),
                'is_visible' => $data->get('is_visible'),
                'status_id' => 5,
                'views' => 0,
                'created_by' => $data->get('user_id')
            ]);
            $res = array(
                'community_details' => $create_community,
                'message'=> 'Community successfully created'
            );
        }


        return $res;
    }

    public function updateCommunityPrivacy($community_id, $data){
        $exists = Community::select('*')
            ->where('id','=',$community_id)
            ->exists();

        if($exists){

            if(($data['is_private'] == 1 || $data['is_private'] == 0 ) && ($data['is_visible'] == 1 || $data['is_visible'] == 0)){
                $community_details = Community::select('*')
                    ->where('id','=',(int)$community_id)
                    ->first();
                if(!empty($data['is_private'])){
                    $community_details->is_private = $data['is_private'];
                }
                if(!empty($data['is_visible'])){
                    $community_details->is_visible = $data['is_visible'];
                }
                if($community_details->isDirty()){
                    $community_details = $community_details->save();
                    $message = "Updated Successfully.";
                }else{
                    $community_details = false;
                    $message = "No Changes have been made.";
                }
            }else{
                $community_details = false;
                $message = "Please check the posted data.";
            }


        }else{
            $community_details = false;
            $message = "No Community Found";
        }

        $res = array(
            'community_details' => $community_details,
            'message'=> $message
        );
        return $res;
    }

    public function updateCommunityViews($community_id){
        $community_details =array();
        $exists = Community::select('*')
            ->where('id','=',$community_id)
            ->exists();

        if($exists){
            $community_details = Community::select('*')
                ->where('id','=',(int)$community_id)
                ->first();
                $community_details->views = $community_details->views + 1;
            if($community_details->isDirty()){
                $community_details = $community_details->save();
                $community_details = $community_details;
            }else{
                $community_details = false;

            }
        }else{
            $community_details = false;

        }

        $res = array(
            'community_details' => $community_details,
        );
        return $res;
    }

    public function updateCommunityProfile($community_id, $data){
        $exists = Community::select('*')
            ->where('id','=',$community_id)
            ->exists();

        if($exists){

            $community_details = Community::select('*')
                ->where('id','=',(int)$community_id)
                ->first();

            if(!empty($data['category'])){
                $community_details->category = $data['category'];
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'Category is required.'
                );
                return $res;
            }
            if(!empty($data['address'])){
                $community_details->address = $data['address'];
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'Address is required.'
                );
                return $res;
            }
            if(!empty($data['city'])){
                $community_details->city = $data['city'];
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'City is required.'
                );
                return $res;
            }
            if(!empty($data['state'])){
                $community_details->state = $data['state'];
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'State is required.'
                );
                return $res;
            }
            if(!empty($data['zip'])){
                $community_details->zip = $data['zip'];
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'Zip is required.'
                );
                return $res;
            }
            if(!empty($data['contact_no'])){
                $community_details->contact_no = $data['contact_no'];
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'Contact number is required.'
                );
                return $res;
            }


            if($community_details->isDirty()){
                $community_details = $community_details->save();
                $res = array(
                    'community_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'community_details' => false,
                'message'=> "No Community Found"
            );
            return $res;

        }


    }

    public function updateCommunityProfilePic($data){

        $exists = Community::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();

        if($exists){

            $community_details = Community::select('*')
                ->where('id','=',(int)$data->get('id'))
                ->first();
            if($data->has('file')){
                $fileName = $data->get('id')."_profile.".$data->file->extension();
                $data->file->move(public_path('uploads'), $fileName);
                $community_details->profile_picture = $fileName;
            }
            if($community_details->isDirty()){
                $community_details = $community_details->save();
                $res = array(
                    'community_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'community_details' => false,
                'message'=> 'No Community Found.'
            );
            return $res;
        }


    }

    public function updateCommunityCoverPhoto($data){

        $exists = Community::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();

        if($exists){

            $community_details = Community::select('*')
                ->where('id','=',(int)$data->get('id'))
                ->first();
            if($data->has('file')){
                $fileName = $data->get('id')."_cover_photo.".$data->file->extension();
                $data->file->move(public_path('uploads'), $fileName);
                $community_details->cover_photo = $fileName;
            }
            if($community_details->isDirty()){
                $community_details = $community_details->save();
                $res = array(
                    'community_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'community_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'community_details' => false,
                'message'=> 'No Community Found.'
            );
            return $res;
        }


    }


}
