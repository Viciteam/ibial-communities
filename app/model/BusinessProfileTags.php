<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BusinessProfileTags extends Model
{
    protected $table = 'business_profile_tags';
    protected $fillable = [
        'business_id',
        'tag'
    ];

    public function getBusinessProfileTags($id){
        $business_details = BusinessProfileTags::select('*')
            ->where('business_id','=',(int)$id)
            ->exists();
        if($business_details){
            $res = BusinessProfileTags::select('tag')
                ->where('business_id','=',(int)$id)
                ->get();

        }else{
            $res = array(
                'business_details' => "",
                'message'=> 'Error. Business not found'
            );
        }

        return $res;
    }
}
