<?php

namespace App\Http\Services;

use App\Data\Repositories\Company\CompanyRepository;

use App\Http\Services\BaseService;

class CompanyService extends BaseService
{   
    private $company;

    public function __construct(
        CompanyRepository $companyRepo
    ){
        $this->company = $companyRepo;
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function insert(array $data)
    {   
       // insert company profile
       $id = $this->company->add($data);

       // dump($id);
       // add hashtags
       $this->company->addHashtags($data['hashtag']);

       $data['id'] = $id;
       return $this->absorb([
           'status' => 200,
           'message' => 'Compnay Created',
           'data' => $data,
       ]);

       // initiate 
    }

    public function addTeam(array $data)
    {
        // initiate 
        $team_id = $this->company->addTeamDetails($data);

        // insert creator to team
        $creator['invitee'] = $data['created_by'];
        $creator['team_id'] = $team_id;
        $creator['status'] = "connected";
        $creator['role'] = "creator";
        $creator['permission'] = "editor";
        $creator['user_id'] = $data['created_by'];
        $creator['position'] = "Creator";

        $this->company->insertInvitation($creator);
        


        $data['id'] = $team_id;
        return $this->absorb([
            'status' => 200,
            'message' => 'Team Successfully Created',
            'data' => $data,
        ]);
    }

    public function invite(array $data)
    {
        // initiate 
        $feedback = [];
        if(!isset($data['invitee'])){
            return $this->absorb([
                'status' => 500,
                'message' => 'Invitee must not be null'
            ]);
        }

        if(!isset($data['team_id'])){
            return $this->absorb([
                'status' => 500,
                'message' => 'Team ID must not be null'
            ]);
        }

        // insert user as per team
        foreach ($data['connection'] as $key => $value) {
            $value['invitee'] = $data['invitee'];
            $value['team_id'] = $data['team_id'];
            $value['status'] = "connected";

            // inject to DB
            $info = $this->company->insertInvitation($value);
            array_push($feedback, $info);
        }

        return $this->absorb([
            'status' => 200,
            'message' => 'Members Successfully Added',
            'data' => $feedback,
        ]);
    }

    public function uninvite(array $data)
    {
        foreach ($data['users'] as $key => $value) {
            $this->company->unInvite($value);
        }

        return $this->absorb([
            'status' => 200,
            'message' => "Team Member(s) deleted"
        ]);
    }

    public function manage(array $data)
    {
        // change roles
        if(isset($data['roles'])){
            foreach ($data['roles'] as $rolekey => $rolevalue) {
                $this->company->changeRole($rolevalue);
            }
        }

        // change permissions
        if(isset($data['permissions'])){
            foreach ($data['permissions'] as $rolekey => $rolevalue) {
                $this->company->changePermissions($rolevalue);
            }
        }

        return $this->absorb([
            'status' => 200,
            'message' => 'Roles and Permissions Updated',
            'data' => $feedback,
        ]);
    }

    public function members(array $data)
    {
        if(!isset($data['team'])){
            return $this->absorb([
                'status' => 500,
                'message' => 'Team ID must not be null'
            ]);
        }

        $filters = [["team_id", "=", $data['team']]];

        if(isset($data['filter'])){
            foreach ($data['filter'] as $key => $value) {
                $dfilter = [$key, "=", $value];
                array_push($filters, $dfilter);
            }
        }

        $info = $this->company->getMembers($filters);

        return $this->absorb([
            'status' => 200,
            'message' => 'Members for Team id '.$data['team'],
            'data' => $info,
        ]);
    }

    public function suggest(array $data)
    {
        $hashtags = $this->company->getHashtags($data);
        dump($hashtags);
    }



}
