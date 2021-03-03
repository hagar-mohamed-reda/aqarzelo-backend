<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Permission;

class PermissionController extends Controller {

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $resources = Permission::orderBy('name')->get();
        return $resources;
    }

    /**
     * Permission a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Permission::validators());

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();
            $resource = new Permission();
            $resource->name = $request->name;
            $resource->display_name = $request->display_name;
            $resource->group_id = $request->group_id;
            
            $resource->save(); 
            watch(__('add Permission ') . $resource->name, "fa fa-building-o");
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
    public function update(Request $request, Permission $resource) {
        try {
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Permission::validators());

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            
            $data = $request->all();  
            $resource->name = $request->name;
            $resource->display_name = $request->display_name;
            $resource->group_id = $request->group_id;
            
            $resource->update(); 
            watch(__('edit Permission ') . $resource->name, "fa fa-building-o");
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
    public function destroy(Permission $resource) {
        try {
            watch(__('remove Permission ') . $resource->name, "fa fa-building-o");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }


}
