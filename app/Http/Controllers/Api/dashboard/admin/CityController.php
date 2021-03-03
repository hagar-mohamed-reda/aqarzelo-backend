<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\City;

class CityController extends Controller
{

    public function __construct() {
        // permission
    } 

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $resources = City::latest()->get();
        return $resources;
    }
 
    /**
     * City a newly created resource in storage.
     * @param Request $request
     * @return Response
     */ 
    public function store(Request $request) {
        $resource = null;
        try { 
              
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), City::roles());
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all(); 
             
            $resource = City::create($data); 
            watch(__('add City ') . $resource->name, "fa fa-building-o");
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
    public function update(Request $request, City $resource) {
        try {  
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), City::roles());
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            
            $data = $request->all(); 
            $resource->update($data);
            watch(__('edit City ') . $resource->name, "fa fa-building-o");
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
    public function destroy(City $resource) { 
        try { 
            watch(__('remove City ') . $resource->name, "fa fa-building-o"); 
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
