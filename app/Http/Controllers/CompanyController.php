<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;

use App\Http\Services\CompanyService;


class CompanyController extends Controller
{
    /**
     * Add Package
     */
    public function insert(
        Request $request,
        CompanyService $add
    )
    {
        $data = $request->all();
        return $add->insert($data);
    }

    public function addTeam(
        Request $request,
        CompanyService $addteam
    )
    {
        $data = $request->all();
        return $addteam->addTeam($data);
    }

    public function invite(
        Request $request,
        CompanyService $invite
    )
    {
        $data = $request->all();
        return $invite->invite($data);
    }

    public function uninvite(
        Request $request,
        CompanyService $uninvite
    )
    {
        $data = $request->all();
        return $uninvite->uninvite($data);
    }

    public function manage(
        Request $request,
        CompanyService $manage
    )
    {
        $data = $request->all();
        return $manage->manage($data);
    }

    // getter
    public function members(
        Request $request,
        CompanyService $members
    )
    {
        $data = $request->all();
        return $members->members($data);
    }

    public function suggest(
        Request $request,
        CompanyService $suggested
    )
    {
        $data = $request->all();
        return $suggested->suggest($data);
    }
}
