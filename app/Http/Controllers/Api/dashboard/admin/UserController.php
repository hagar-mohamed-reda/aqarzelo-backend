<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Role;
use DB;
use App\helper\Helper;

class UserController extends Controller
{

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $query = User::with(['company', 'role'])->latest();

        if (request()->search)
            $query
                ->where('name', 'like', '%'.request()->search.'%')
                ->orWhere('address', 'like', '%'.request()->search.'%')
                ->orWhere('phone', 'like', '%'.request()->search.'%')
                ->orWhere('email', 'like', '%'.request()->search.'%');

        if (request()->company_id > 0)
            $query->where('company_id', request()->company_id);

        if (request()->city_id > 0)
            $query->where('city_id', request()->city_id);

        if (request()->area_id > 0)
            $query->where('area_id', request()->area_id);

        if (request()->type)
            $query->where('type', request()->type);

        if (request()->user()->company_id != 1) {
            $query->where('company_id', request()->user()->company_id);
        }

        return $query->paginate(60);
    }

    /**
     * User a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;
        try {
            $userNumber = User::where('company_id', $request->user()->company_id)->count();
            $planUserNumber = optional(optional($request->user())->getCurrentPlan())->user_number;

            if ($userNumber >= $planUserNumber && $request->user()->company_id != 1) {
                return responseJson(0, str_replace('{n}', $planUserNumber, __('your cant create more than {n} users')));
            }

            $validator =   validator()->make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required|min:8',
                'photo' => 'mimes:jpeg,jpg,bmp,png'

            ]);
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();
            if (isset($data['password']))
                $data['password'] = bcrypt($data['password']);

            $data['api_token'] = randToken();

            $resource = User::create($data);

            if ($request->role_id > 0) {
                $role = Role::find($request->role_id);
                if ($role && !$resource->hasRole($role))
                    $resource->attachRole($role);
            }

            if ($request->hasFile('photo')) {
                $resource->photo = Helper::uploadImg($request->file("photo"), "/users/");
                $resource->update();
            }


            watch(__('add User ') . $resource->name, "fa fa-user");
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
    public function update(Request $request, User $resource) {
        try {
            $validator =   validator()->make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'phone' => 'required|unique:users,phone,'.$request->id,
                'password' => 'required|min:8',

            ]);
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }

            $data = $request->all();
            if (isset($data['photo']))
                unset($data['photo']);

            if ($request->password != $resource->password)
                $data['password'] = bcrypt($data['password']);

            $resource->update($data);

            if ($request->role_id > 0) {
                // remove old role
                DB::table('role_user')->where('user_id', $resource->id)->delete();

                $role = Role::find($request->role_id);
                if ($role && !$resource->hasRole($role))
                    $resource->attachRole($role);
            }

            if ($request->hasFile('photo')) {
                $resource->photo = Helper::uploadImg($request->file("photo"), "/users/");
                $resource->update();
            }

            watch(__('edit User ') . $resource->name, "fa fa-user");
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
    public function destroy(User $resource) {
        try {
            watch(__('remove User ') . $resource->name, "fa fa-user");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
