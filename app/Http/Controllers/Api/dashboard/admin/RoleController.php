<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Role;
use App\Permission;
use DB;

class RoleController extends Controller
{

    public function __construct() {
        // permission
    } 

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $query = Role::with('permissions')->latest();
         
        //return request()->user()->company_id;
        if (request()->user()->company_id != 1) {
            $query->where('company_id', request()->user()->company_id);
        }
        
        return $query->get();
    }
 
    /**
     * Role a newly created resource in storage.
     * @param Request $request
     * @return Response
     */ 
    public function store(Request $request) {
        $resource = null;
        try { 
              
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), [
                "name" =>  "required",
                "display_name" =>  "required", 
                "company_id" =>  "required"
            ]);
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();
            $data['role_id'] = $request->company_id> 0? $request->company_id : $request->user()->company_id;
             
            $resource = Role::create($data);
            watch(__('add Role ') . $resource->name, "fa fa-list-th");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        
        return responseJson(1, __('done'), $resource);
    }
 
    /**
     * Role a newly created resource in storage.
     * @param Request $request
     * @return Response
     */ 
    public function updatePermission(Request $request, Role $resource) { 
        try { 
            
            $data = $request->all(); 
            
            // remove old
            DB::table('permission_role')->where('role_id', $resource->id)->delete();
            
            //return $data['permissions'];
            foreach($data['permissions'] as $row) { 
                $permission = Permission::find($row);
                if ($permission && !$resource->hasPermission($permission))
                    $resource->attachPermission($permission);
            }
             
            
            watch(__('update permission of resource ') . $resource->name, "fa fa-list-th");
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
    public function update(Request $request, Role $resource) {
        try { 
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), [
                "name" =>  "required",
                "display_name" =>  "required", 
                "company_id" =>  "required"
            ]);
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all(); 
            $data['role_id'] = $request->company_id> 0? $request->company_id : $request->user()->company_id;
            $resource->update($data);
            watch(__('edit Role ') . $resource->name, "fa fa-list-th");
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
    public function destroy(Role $resource) { 
        try { 
            watch(__('remove Role ') . $resource->name, "fa fa-list-th"); 
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
