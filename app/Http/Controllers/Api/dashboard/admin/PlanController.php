<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Plan;

class PlanController extends Controller
{

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $query = Plan::with(['country', 'city', 'area'])->latest();

        if (request()->company_id > 0)
            $query->where('model_id', request()->company_id)->whereIn('model_type', ['broker', 'developer']);

        if (request()->city_id > 0)
            $query->where('city_id', request()->city_id);

        if (request()->area_id > 0)
            $query->where('area_id', request()->area_id);


        return $query->get();
    }

    /**
     * Plan a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Plan::roles());

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();

            $resource = Plan::create($data);
            watch(__('add Plan ') . $resource->name, "fa fa-map");
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
    public function update(Request $request, Plan $resource) {
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Plan::roles());

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();
            $resource->update($data);
            watch(__('edit Plan ') . $resource->name, "fa fa-map");
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
    public function destroy(Plan $resource) {
        try {
            watch(__('remove Plan ') . $resource->name, "fa fa-map");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
