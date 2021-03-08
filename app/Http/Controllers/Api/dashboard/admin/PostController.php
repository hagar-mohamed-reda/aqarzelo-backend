<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\helper\Helper;
use App\Post;
use App\User;
use App\Message;
use App\Http\Controllers\Api\post\MainController;


class PostController extends Controller
{

    public function __construct() {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $query = Post::query();

        if (request()->company_id > 0) {
            $ids = User::where('company_id', request()->company_id)->pluck('id')->toArray();
            $query->whereIn('user_id', $ids);
        }

        if (request()->search)
            $query
            ->where('title_ar', 'like', '%'.request()->search.'%')
            ->where('title_en', 'like', '%'.request()->search.'%')
            ->where('description', 'like', '%'.request()->search.'%');

        if (request()->city_id > 0)
            $query->where('city_id', request()->city_id);

        if (request()->area_id > 0)
            $query->where('area_id', request()->area_id);

        if (request()->user()->company_id != 1) {
            $ids = User::where('company_id', request()->user()->company_id)->pluck('id')->toArray();
            $query->whereIn('user_id', $ids);
        }

        if (request()->show_recommended == '1') {
            $query->where('show_recommended', '1');
        }

        return $query->latest()->paginate(10);
    }

    public function load(Post $resource) {
        return $resource;
    }

    /**
     * Post a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $resource = null;

        $ids = User::where('company_id', $request->user()->company_id)->pluck('id')->toArray();
        $postNumber = Post::whereIn('user_id', $ids)->count();
        $planPostNumber = optional(optional($request->user())->getCurrentPlan())->max_post;

        if ($postNumber >= $planPostNumber && $request->user()->company_id != 1) {
            return responseJson(0, str_replace('{n}', $planPostNumber, __('your cant create more than {n} posts')));
        }

        return (new MainController())->addPost($request);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Post $resource) {
        $request->post_id = $resource->id;
        // check if the user login
        $user = User::auth($request);

        if (!$user) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        }

        try {
            // find the post
            $post = Post::find($request->post_id);

            // remove old images
            if ($request->is_edit_from_website) {
                if ($post) {
                    $post->images()->update(['post_id' => null]);
                }
            }


            $message_ar = trans("messages_ar.done");
            $message_en = trans("messages_en.done");

            $data = $request->all();

            if (isset($data['has_parking'])) {
                $data['has_parking'] = $data['has_parking'] = true ? 1 : 0;
            }

            if (isset($data['has_garden'])) {
                $data['has_garden'] = $data['has_garden'] = true ? 1 : 0;
            }

            if (isset($data['furnished'])) {
                $data['furnished'] = $data['furnished'] = true ? 1 : 0;
            }

            // update if exist
            ($post) ? $post->update($data) : null;


            return Message::success($message_en, $message_ar, $post->fresh());
        } catch (Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Post $resource) {
        try {
            watch(__('remove Post ') . $resource->name, "fa fa-address-book");
            $resource->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
