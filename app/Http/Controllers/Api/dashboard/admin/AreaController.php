<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Area;

class AreaController extends Controller
{

    public function __construct() {
        // permission
    } 

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $resources = Area::latest()->get();
        return $resources;
    }
 
    /**
     * Area a newly created resource in storage.
     * @param Request $request
     * @return Response
     */ 
    public function store(Request $request) {
        $resource = null;
        try { 
              
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Area::roles());
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all(); 
             
            $resource = Area::create($data); 
            watch(__('add Area ') . $resource->name, "fa fa-map-marker");
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
    public function update(Request $request, Area $resource) {
        try { 
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), Area::roles());
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            
            $data = $request->all(); 
            $resource->update($data);
            watch(__('edit Area ') . $resource->name, "fa fa-map-marker");
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
    public function destroy(Area $resource) { 
        try { 
            watch(__('remove Area ') . $resource->name, "fa fa-map-marker"); 
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
