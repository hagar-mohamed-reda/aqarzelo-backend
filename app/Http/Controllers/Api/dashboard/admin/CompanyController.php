<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Company;
use App\helper\Helper;

class CompanyController extends Controller
{

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $query = Company::latest();

        if (request()->search)
            $query
                ->where('name', 'like', '%'.request()->search.'%')
                ->orWhere('address', 'like', '%'.request()->search.'%')
                ->orWhere('phone', 'like', '%'.request()->search.'%')
                ->orWhere('email', 'like', '%'.request()->search.'%');

        if (request()->type) {
            $query->where('type', request()->type);
        }

        if (request()->city_id > 0) {
            $query->where('city_id', request()->city_id);
        }

        if (request()->area_id > 0) {
            $query->where('area_id', request()->area_id);
        }

        if (request()->user()->company_id != 1) {
            $query->where('id', request()->user()->company_id);
        }

        if (request()->paging == '0')
            return $query->get();

        return $query->paginate(60);
    }

    /**
     * Company a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->all(), [
                "name" =>  "required"
            ]);

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }

            $data = $request->all();
            if (isset($data['photo']))
                unset($data['photo']);

            $data = $request->all();

            $resource = Company::create($data);

            if ($request->hasFile('photo')) {
                $resource->photo = Helper::uploadImg($request->file("photo"), "/company/");
                $resource->update();
            }

            watch(__('add Company ') . $resource->name, "fa fa-bank");
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
    public function update(Request $request, Company $resource) {
        try {

            $data = $request->all();
            if (isset($data['photo']))
                unset($data['photo']);

            $data = $request->all();
            $resource->update($data);

            if ($request->hasFile('photo')) {
                $resource->photo = Helper::uploadImg($request->file("photo"), "/company/");
                $resource->update();
            }

            watch(__('edit Company ') . $resource->name, "fa fa-bank");
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
    public function destroy(Company $resource) {
        try {
            watch(__('remove Company ') . $resource->name, "fa fa-bank");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
