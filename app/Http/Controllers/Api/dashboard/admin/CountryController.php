<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Country;
use App\helper\Helper;

class CountryController extends Controller {

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $resources = Country::latest()->get();
        return $resources;
    }

    /**
     * Country a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Country::roles());

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();

            $resource = Country::create($data);

            if ($request->hasFile('icon')) {
                $resource->icon = Helper::uploadImg($request->file("icon"), "/country/");
                $resource->update();
            }

            watch(__('add Country ') . $resource->name, "fa fa-building-o");
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
    public function update(Request $request, Country $resource) {
        try {
            $data = $request->all();
            $resource->update($data);

            if ($request->hasFile('icon')) {
                if (file_exists(public_path($resource->icon)))  {
                    unlink(public_path($resource->icon));
                }

                $resource->icon = Helper::uploadImg($request->file("icon"), "/country/");
                $resource->update();
            }

            watch(__('edit Country ') . $resource->name, "fa fa-building-o");
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
    public function destroy(Country $resource) {
        try {
            watch(__('remove Country ') . $resource->name, "fa fa-building-o");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }


}
