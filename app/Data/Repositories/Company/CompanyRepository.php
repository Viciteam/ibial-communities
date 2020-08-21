<?php


namespace App\Data\Repositories\Company;

use App\Data\Models\Company\BusinessModel;
use App\Data\Models\Company\HashtagModel;
use App\Data\Models\Company\TeamModel;
use App\Data\Models\Company\TeamMembersModel;

use App\Data\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

/**
 * Class FundRepository
 *
 * @package App\Data\Repositories\Users
 */
class CompanyRepository extends BaseRepository
{
    /**
     * Declaration of Variables
     */
    private $business_model;
    private $hashtag_model;
    private $team_model;
    private $team_member_model;

    /**
     * PropertyRepository constructor.
     * @param Fund 
     */
    public function __construct(
        BusinessModel $businessModel,
        HashtagModel $hashtagModel,
        TeamModel $teamModel,
        TeamMembersModel $teamMemberModel
    ){
        $this->business_model = $businessModel;
        $this->hashtag_model = $hashtagModel;
        $this->team_model = $teamModel;
        $this->team_member_model = $teamMemberModel;
    }

    public function add($data)
    {
        // $data['created_by'] = json_encode($data['user_id']);
        $data['hashtag'] = json_encode($data['hashtag']);
        $data['skills'] = json_encode($data['skills']);
        $data['language'] = json_encode($data['language']);
        $data['logo'] = (isset($data['logo']) || $data['logo'] != "" ? $data['logo'] : "");
        $attributes = (isset($data['attributes']) || $data['attributes'] != "" ? $data['attributes'] : []);
        $data['attributes'] = json_encode($attributes);

        $prods = $this->business_model->init($data);

        if (!$prods->validate($data)) {
            $errors = $prods->getErrors();
            // dump($errors);
            return 'error on validate';
        }

        // region Data insertion
        if (!$prods->save()) {
            $errors = $prods->getErrors();
            dump($errors);
            return 'error on saving';
        }
        
        return $prods->id;

    }


    public function addHashtags($hashtags)
    {
        // dump($hashtags);

        foreach ($hashtags as $key => $value) {
            // check if hashtag exist
            if($this->hashCheck($value)){
                $this->hashtag_model->where("tag_name", "=", $value)->increment("tag_count");
            } else {
                $this->hashtag_model->create([
                    'tag_name' => $value,
                    'tag_count' => 1
                ]);
            }
        }
    }
    
    public function hashCheck($hashtag)
    {
        if($this->hashtag_model->where("tag_name", "=", $hashtag)->exists()){
            return true;
        } else {
            return false;
        }
    }

    public function addTeamDetails($data)
    {
        // dump($data);
        $data['attributes'] = (isset($data['attributes']) ? json_encode($data['attributes']) : json_encode([]));

        $prods = $this->team_model->init($data);

        if (!$prods->validate($data)) {
            $errors = $prods->getErrors();
            // dump($errors);
            // return 'error on validate';
        }

        // region Data insertion
        if (!$prods->save()) {
            $errors = $prods->getErrors();
            // dump($errors);
            // return 'error on saving';
        }
        
        return $prods->id;
    }

    public function insertInvitation($data)
    {
        $prods = $this->team_member_model->init($data);

        if (!$prods->validate($data)) {
            $errors = $prods->getErrors();
            // dump($errors);
            // return 'error on validate';
        }

        // region Data insertion
        if (!$prods->save()) {
            $errors = $prods->getErrors();
            // dump($errors);
            // return 'error on saving';
        }

        $data['id'] = $prods->id;
        
        return $data;
    }

    public function changeRole($data)
    {
        $this->team_member_model->where("id", "=", $data['member_id'])->update([
            "role" => $data['change_to']
        ]);
    }

    public function changePermissions($data)
    {
        $this->team_member_model->where("id", "=", $data['member_id'])->update([
            "permission" => $data['change_to']
        ]);
    }

    public function getMembers($data)
    {
       return $this->returnToArray($this->team_member_model->where($data)->get()); 
    }

    public function unInvite($data)
    {
        $this->team_member_model->where("id", "=", $data)->delete();
    }

    public function getHashtags($data)
    {
        $hashtags = [];
        
        // for skills and language
        if(isset($data['skills']) || isset($data['language'])){
            $hashes = $this->getCompanyByDetails($data);
            foreach ($hashes as $hashkey => $hashvalue) {
                array_push($hashtags, $hashvalue);
            }
        }

        // for the attributes
        if(isset($data['attributes'])){
            $hashes = $this->getCompanybyAttr($data['attributes']);
            foreach ($hashes as $hashkey => $hashvalue) {
                array_push($hashtags, $hashvalue);
            }
        }

        $slimhash = array_unique($hashtags);

        // dump($slimhash);

        return $slimhash;
    }

    public function getCompanyByDetails($data)
    {
        $hashtags = [];

        // init model
        $business_model = $this->business_model;

        if(isset($data['skills'])){
            // get skills
            foreach ($data['skills'] as $key => $value) {
                $business_model->orWhere("skills", "like", "%".$value."%");
            }
        }
        
        if(isset($data['language'])){
            // get language
            foreach ($data['language'] as $key => $value) {
                $business_model->orWhere("language", "like", "%".$value."%");
            }
        }

        $business = $this->returnToArray($business_model->get());

        foreach ($business as $bskey => $bsvalue) {
            $dhash = json_decode($bsvalue['hashtag']);
            foreach ($dhash as $dhkey => $dhvalue) {
                array_push($hashtags, $dhvalue);
            }
        }
        
        return $hashtags;
    }

    public function getCompanybyAttr($data)
    {
        $hashtags = [];
        
        // init model
        $business_model = $this->business_model;

        // as per attribute item
        foreach ($data as $mainkey => $mainvalue) {
            // as per item
            foreach ($mainvalue as $pikey => $pivalue) {
                $business_model->orWhere("attributes", "like", "%".$pivalue."%");
            }
        }


        $business = $this->returnToArray($business_model->get());

        foreach ($business as $bskey => $bsvalue) {
            $dhash = json_decode($bsvalue['hashtag']);
            foreach ($dhash as $dhkey => $dhvalue) {
                array_push($hashtags, $dhvalue);
            }
        }

        return $hashtags;
    }
    
    
}
