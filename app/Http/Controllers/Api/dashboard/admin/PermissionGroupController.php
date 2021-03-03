<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\PermissionGroup;

class PermissionGroupController extends Controller {

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $query = PermissionGroup::with(['permissions'])->orderBy('sort');
        
        if (request()->user()->company_id != 1) {
            $query->where('is_admin', '!=', '1');
        }
        
        return $query->get();
    }

    /**
     * PermissionGroup a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), PermissionGroup::roles());

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();

            $resource = PermissionGroup::create($data);
            watch(__('add PermissionGroup ') . $resource->name, "fa fa-building-o");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, PermissionGroup $resource) {
        try {
            $data = $request->all();
            $resource->update($data);
            watch(__('edit PermissionGroup ') . $resource->name, "fa fa-building-o");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(PermissionGroup $resource) {
        try {
            watch(__('remove PermissionGroup ') . $resource->name, "fa fa-building-o");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }


}
