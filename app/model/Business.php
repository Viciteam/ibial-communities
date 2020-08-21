<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Business extends Model{
    protected $table = 'business';
    protected $fillable = [
        'name', 'is_private', 'is_visible','status_id','views','created_by'
    ];
    public function getBusinessDetails($business_id){

        $business_details = Business::select('*')
            ->where('id','=',(int)$business_id)
            ->exists();
        if($business_details){
            $business_details = Business::select('*')
                ->where('id','=',(int)$business_id)
                ->first();
            $res = array(
                'business_details' => $business_details,
                'message'=> 'Success'
            );

        }else{
            $res = array(
                'business_details' => "",
                'message'=> 'Error. Business not found'
            );
        }

        return $res;
    }
    public function createBusiness($data){
        $exists = Business::select('*')
            ->where('name','=',$data->get('name'))
            ->exists();

        if($exists){
            $res = array(
                'business_details' => "",
                'message'=> 'Error. Business name is already taken'
            );
        }else{
            $create_business = Business::create([
                'name' => $data->get('name'),
                'is_private' => $data->get('is_private'),
                'is_visible' => $data->get('is_visible'),
                'status_id' => 5,
                'views' => 0,
                'created_by' => $data->get('user_id')
            ]);
            $res = array(
                'business_details' => $create_business,
                'message'=> 'Business successfully created'
            );
        }
        return $res;
    }
    public function updateBusinessPrivacy($business_id, $data){
        $exists = Business::select('*')
            ->where('id','=',$business_id)
            ->exists();

        if($exists){

            if(($data['is_private'] == 1 || $data['is_private'] == 0 ) && ($data['is_visible'] == 1 || $data['is_visible'] == 0)){
                $business_details = Business::select('*')
                    ->where('id','=',(int)$business_id)
                    ->first();
                if(!empty($data['is_private'])){
                    $business_details->is_private = $data['is_private'];
                }
                if(!empty($data['is_visible'])){
                    $business_details->is_visible = $data['is_visible'];
                }
                if($business_details->isDirty()){
                    $business_details = $business_details->save();
                    $message = "Updated Successfully.";
                }else{
                    $business_details = false;
                    $message = "No Changes have been made.";
                }
            }else{
                $business_details = false;
                $message = "Please check the posted data.";
            }


        }else{
            $business_details = false;
            $message = "No Business Found";
        }

        $res = array(
            'business_details' => $business_details,
            'message'=> $message
        );
        return $res;
    }
    public function updateBusinessViews($business_id){
        $business_details =array();
        $exists = Business::select('*')
            ->where('id','=',$business_id)
            ->exists();

        if($exists){
            $business_details = Business::select('*')
                ->where('id','=',(int)$business_id)
                ->first();
            $business_details->views = $business_details->views + 1;
            if($business_details->isDirty()){
                $business_details = $business_details->save();
                $business_details = $business_details;
            }else{
                $business_details = false;

            }
        }else{
            $business_details = false;

        }

        $res = array(
            'business_details' => $business_details,
        );
        return $res;
    }
    public function updateBusinessProfile($business_id, $data){
        $exists = Business::select('*')
            ->where('id','=',$business_id)
            ->exists();

        if($exists){

            $business_details = Business::select('*')
                ->where('id','=',(int)$business_id)
                ->first();

            if(!empty($data['category'])){
                $business_details->category = $data['category'];
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'Category is required.'
                );
                return $res;
            }
            if(!empty($data['address'])){
                $business_details->address = $data['address'];
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'Address is required.'
                );
                return $res;
            }
            if(!empty($data['city'])){
                $business_details->city = $data['city'];
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'City is required.'
                );
                return $res;
            }
            if(!empty($data['state'])){
                $business_details->state = $data['state'];
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'State is required.'
                );
                return $res;
            }
            if(!empty($data['zip'])){
                $business_details->zip = $data['zip'];
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'Zip is required.'
                );
                return $res;
            }
            if(!empty($data['contact_no'])){
                $business_details->contact_no = $data['contact_no'];
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'Contact number is required.'
                );
                return $res;
            }


            if($business_details->isDirty()){
                $business_details = $business_details ->save();
                $res = array(
                    'business_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'business_details' => false,
                'message'=> "No Business Found"
            );
            return $res;

        }


    }
    public function updateBusinessProfilePic($data){

        $exists = Business::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();

        if($exists){

            $business_details = Business::select('*')
                ->where('id','=',(int)$data->get('id'))
                ->first();
            if($data->has('file')){
                $fileName = $data->get('id')."_profile.".$data->file->extension();
                $data->file->move(public_path('uploads'), $fileName);
                $business_details->profile_picture = $fileName;
            }
            if($business_details->isDirty()){
                $business_details = $business_details->save();
                $res = array(
                    'business_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'business_details' => false,
                'message'=> 'No Business Found.'
            );
            return $res;
        }


    }
    public function updateBusinessCoverPhoto($data){

        $exists = Business::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();

        if($exists){

            $business_details = Business::select('*')
                ->where('id','=',(int)$data->get('id'))
                ->first();
            if($data->has('file')){
                $fileName = $data->get('id')."_cover_photo.".$data->file->extension();
                $data->file->move(public_path('uploads'), $fileName);
                $business_details->cover_photo = $fileName;
            }
            if($business_details->isDirty()){
                $business_details = $business_details->save();
                $res = array(
                    'business_details' => true,
                    'message'=> 'Updated Successfully.'
                );
                return $res;
            }else{
                $res = array(
                    'business_details' => false,
                    'message'=> 'No Changes have been made.'
                );
                return $res;
            }



        }else{
            $res = array(
                'business_details' => false,
                'message'=> 'No Business Found.'
            );
            return $res;
        }


    }

    public function addBusinessPartner($data){
        $response = array();
        $status = false;
        $message = "Partnership successfully created. Awaiting confirmation from your business partner";
        $exists = Business::select('*')
            ->where('id','=',(int)$data->get('id'))
            ->exists();
        if($exists){
            $partner_exists = Business::select('*')
                ->where('id','=',(int)$data->get('partner_id'))
                ->exists();
            if($partner_exists){
                $checker = DB::table('business_partnership')
                    ->select('id')
                    ->where([
                        ['business_name', '=', $data->get('business_name')],

                    ])
                    ->exists();

                if ($checker){
                    $message = "Business partnership name already exist.";
                    $status = false;
                }else{
                    $add_business_partner = DB::table('business_partnership')->insert([
                        'business_id' => $data->get('id'),
                        'business_partner_id' => $data->get('partner_id'),
                        'business_type' => $data->get('business_type'),
                        'business_partnership_terms' => $data->get('business_partnership_terms'),
                        'location' =>  $data->get('location'),
                        'business_name' => $data->get('business_name'),
                        'business_tag_line' => $data->get('business_tag_line'),
                        'status_id' => 1
                    ]);
                    $add_business_partner = DB::table('business_partnership')->insert([
                        'business_id' => $data->get('partner_id'),
                        'business_partner_id' => $data->get('id'),
                        'business_type' => $data->get('business_type'),
                        'business_partnership_terms' => $data->get('business_partnership_terms'),
                        'location' =>  $data->get('location'),
                        'business_name' => $data->get('business_name'),
                        'business_tag_line' => $data->get('business_tag_line'),
                        'status_id' => 2
                    ]);
                    $status = true;
                }
            }else{
                $message = "Friend ID can't be found.";
                $status = false;
            }
        }else{
            $message = "User ID can't be found.";
            $status = false;
        }

        $response = array(
            'msg' => $message,
            'status' => $status
        );
        return $response;

    }
    public function acceptBusinessPartnerRequest($data){

        $response = array();
        $status = false;
        $message = "Partnership successfully accepted";


                $checker = DB::table('business_partnership')
                    ->select('id')
                    ->where([
                        ['business_id', '=', $data->get('id')],
                        ['business_partner_id', '=', $data->get('partner_id')],
                        ['status_id', '=', 2]
                    ])
                    ->exists();

                if ($checker){
                    $accept = DB::table('business_partnership')
                        ->where([
                            ['business_id', '=', $data->get('id')],
                            ['business_partner_id', '=', $data->get('partner_id')],
                            ['status_id', '=', 2]
                        ])
                        ->update(['status_id' => 3]);
                    $update_accept = DB::table('business_partnership')
                        ->where([
                            ['business_id', '=', $data->get('partner_id')],
                            ['business_partner_id', '=', $data->get('id')],
                            ['status_id', '=', 1]
                        ])
                        ->update(['status_id' => 3]);
                    $status = true;
                }else{


                    $message = "Partnership request not found.";
                    $status = false;

                }



        $response = array(
            'msg' => $message,
            'status' => $status
        );
        return $response;

    }

    public function getPartners($id){
        $response = array();
        $status = false;
        $message = "Success";



        $partners = DB::table('business_partnership')
            ->where([
                ['business_id', '=', $id]
            ])
            ->get();

        $response = array(
            'msg' => $message,
            'data' => $partners
        );
        return $response;
    }
}
