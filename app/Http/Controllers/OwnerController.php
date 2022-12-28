<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Owners\CreateUpdateRequest;
use App\Http\Resources\OwnerResource;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = ($request->per_page) ? $request->per_page : 15;
        return $this->sendResponse(Owner::paginate($per_page), "Owners per page Obtained successfully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateRequest $request)
    {
        $owner = Owner::create($request->all());
        return $this->sendResponse(new OwnerResource($owner), 'Owner created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return $this->sendResponse(new OwnerResource($owner), 'Owner retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateRequest $request, Owner $owner)
    {
        $owner->fill($request->all());
        $owner->save();
        return $this->sendResponse(new OwnerResource($owner), 'Owner retrieved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();
        return $this->sendResponse([], 'Owner deleted successfully.');
    }
}
