<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Post;
use App\Category;
use App\City;
use App\User;

class DashboardController extends Controller
{

    public function __construct() {
        // permission
    } 

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
       $postQuery = Post::query();
       
       
        if (request()->user()->company_id > 1) {
            $ids = User::where('company_id', request()->user()->company_id)->pluck('id')->toArray();
            $postQuery->whereIn('user_id', $ids);
        }
        
       $categories = Category::all();
       $data = [];
       
       foreach($categories as $item) {
           $item->post_count = (clone $postQuery)->where('category_id', $item->id)->count();
           $data[] = [$item->name_ar, $item->post_count];
       }
        
       $cities = City::all();
       $data2 = [];
       
       foreach($cities as $item) {
           $item->post_count = (clone $postQuery)->where('city_id', $item->id)->count();
           $data2[] = [$item->name_ar, $item->post_count];
       }
       // 'extra_super_lux','super_lux','lux','semi_finished','without_finished','core&chel'
       
       return [
           "chart" => $data,
           "chart2" => $data2,
           "posts" => [
               [
                   "status" => "accepted",
                   "post_count" => (clone $postQuery)->where('status', 'accepted')->count(),
               ],
               [
                   "status" => "pending",
                   "post_count" => (clone $postQuery)->where('status', 'pending')->count(),
               ],
               [
                   "status" => "refused",
                   "post_count" => (clone $postQuery)->where('status', 'refused')->count(),
               ],
               [
                   "status" => "user_trash",
                   "post_count" => (clone $postQuery)->where('status', 'user_trash')->count(),
               ]
           ]
       ];
    }
  
}
