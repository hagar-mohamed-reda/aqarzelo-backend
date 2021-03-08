<?php

namespace App\Http\Controllers\Api\post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Helper;
use App\Dictionary;
use App\Company;
use App\User;
use App\Post;
use App\PostReview;
use App\Image;
use App\Plan;
use App\PlanAssign;
use App\Http\Controllers\Api\post\criteria\DistanceCriteria;
use App\Http\Controllers\Api\post\criteria\CityCriteria;
use App\Http\Controllers\Api\post\criteria\AreaCriteria;
use App\Http\Controllers\Api\post\criteria\PriceCriteria;
use App\Http\Controllers\Api\post\criteria\BedRoomCriteria;
use App\Http\Controllers\Api\post\criteria\BathRoomCriteria;
use App\Http\Controllers\Api\post\criteria\TypeCriteria;
use App\Http\Controllers\Api\post\criteria\SpaceCriteria;
use App\Http\Controllers\Api\post\criteria\FinishTypeCriteria;

class MainController extends Controller {

    /**
     * create post
     *
     * @param Request $request
     * @return array $response
     */
    public function addPost(Request $request) {

        // check if the user login
        $user = User::auth($request);

        if (!$user) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        }

        // check on user plan
        $postNumber = User::where('company_id', $request->user()->company_id)->count();
        $planPostNumber = optional(optional($request->user())->getCurrentPlan())->max_post;

        if ($postNumber >= $planPostNumber && $request->user()->company_id != 1) {
            return responseJson(0, __(str_replace('{n}', $planPostNumber, 'your cant create more than {n} posts')));
        }


        // if the post is exist update it
        if ($request->has("id")) {
            return $this->updatePost($request);
        }

        // validate the data
        $validator = validator()->make($request->all(), [
            'title' => 'required',
            'title_ar' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'lng' => 'required',
            'lat' => 'required',
            'owner_type' => 'required',
            'space' => 'required',
            'price_per_meter' => 'required',
            'city_id' => 'required',
            'area_id' => 'required',
            'payment_method' => 'required',
            'finishing_type' => 'required',
        ]);

        if ($validator->fails()) {
            return Message::error($validator->errors()->first(), trans("messages_ar.fill_all_post_data"));
        }

        try {
            $message_ar = trans("messages_ar.done");
            $message_en = trans("messages_en.done");

            $data = $request->all();
            $data['user_id'] = $user->id;
            //$data['price'] = $request->price_per_meter * $request->space;

            if (!$request->phone)
                $data['phone'] = $user->phone;

            if (isset($data['has_parking'])) {
                $data['has_parking'] = $data['has_parking'] = true ? 1 : 0;
            }

            if (isset($data['has_garden'])) {
                $data['has_garden'] = $data['has_garden'] = true ? 1 : 0;
            }

            if (isset($data['furnished'])) {
                $data['furnished'] = $data['furnished'] = true ? 1 : 0;
            }
            $post = Post::create($data);

            // save images
            /*foreach ($data['images'] as $item) {
                if (isset($item['photo_url'])) {
                    $filename = randToken() . ".png";
                    $this->base64_to_jpeg($item['photo_url'], $filename);
                }
            }*/

            // if company of the user is not the admin company the post will be accepted
            if ($user->company) {
                if (!$user->company->isAdmin()) {
                    $post->update([
                        "status" => "accepted"
                    ]);


                    // title of notification
                    $title_ar = trans("messages_ar.new_post", ["user" => $user->name]);
                    $title_en = trans("messages_en.new_post", ["user" => $user->name]);

                    // notify all user
                    User::notifyAll($title_ar, $title_en, $post->title, $post->title, $post->id);
                }
            } else {
                $message_ar = trans("messages_ar.post_pending_from_admin");
                $message_en = trans("messages_en.post_pending_from_admin");

                // notify the user
                $user->notify(
                        trans("messages_ar.post_alert", ["number" => $post->id]), trans("messages_en.post_alert", ["number" => $post->id]), $message_ar, $message_en, $post->id
                );
            }

            // link the temp post with exist post
            if ($user->post_id_tmp) {
                $post->id = $user->post_id_tmp;
                $post->save();
            }


            // empty post_id_tmp
            $user->update([
                "post_id_tmp" => null
            ]);

            return Message::success($message_en, $message_ar, $post->fresh());
        } catch (Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen($output_file, 'wb');

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode(',', $base64_string);

        // we could add validation here with ensuring count( $data ) > 1
        fwrite($ifp, base64_decode($data[1]));

        // clean up the file resource
        fclose($ifp);

        return $output_file;
    }

    /**
     * update post information
     *
     * @param Request $request
     * @return array $response
     */
    public function updatePost(Request $request) {
        // check if the user login
        $user = User::auth($request);

        if (!$user) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        }
        /*
          // validate the data
          $validator = validator()->make($request->all(), [
          'post_id' => 'required',
          'title' => 'required',
          'category_id' => 'required',
          'type' => 'required',
          'lng' => 'required',
          'lat' => 'required',
          'owner_type' => 'required',
          'space' => 'required',
          'price_per_meter' => 'required',
          'city_id' => 'required',
          'area_id' => 'required',
          'payment_method' => 'required',
          'finishing_type' => 'required',
          ]);

          if ($validator->fails()) {
          return Message::error(trans("messages_en.fill_all_post_data"), trans("messages_ar.fill_all_post_data"));
          } */

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
            // add the user_id
            $data['user_id'] = $user->id;

            // update if exist
            ($post) ? $post->update($data) : null;


            return Message::success($message_en, $message_ar, $post->fresh());
        } catch (Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    /**
     * get all post around point
     *
     * @param Request $request
     * @return array $response
     */
    public function search(Request $request) {
        try {
            // criteria
            $distanceCriteria = new DistanceCriteria($request->lat, $request->lng, $request->city_id);
            $priceCriteria = new PriceCriteria($request->price1, $request->price2);
            $cityCriteria = new CityCriteria($request->city_id);
            $areaCriteria = new AreaCriteria($request->area_id);
            $spaceCriteria = new SpaceCriteria($request->space1, $request->space2);
            $typeCriteria = new TypeCriteria($request->type);
            $finishTypeCriteria = new FinishTypeCriteria($request->finishing_type);
            $bedRoomCriteria = new BedRoomCriteria($request->bedroom_number);
            $bathRoomCriteria = new BathRoomCriteria($request->bathroom_number);

            // posts not active
            $companyIds = Company::where('active', 'active')->pluck('id')->toArray();
            $userIds = User::whereIn('company_id', $companyIds)->where('active', 'active')->pluck('id')->toArray();

            // init query
            $query = Post::select('*')
            ->where('status', "accepted")
            ->whereIn('user_id', $userIds)
            ->where('is_sold', "!=", 1);

            $posts = [];
            $search = false;

            if ($request->has("lat") && $request->has("lng")) {
                $query = $distanceCriteria->filter($query);
                $search = true;
            }

            if ($request->has("price1") && $request->has("price2") && ($request->price1 != null && $request->price2 != null)) {
                $query = $priceCriteria->filter($query);
                $search = true;
            }

            if ($request->has("city_id") && $request->city_id != null) {
                $query = $cityCriteria->filter($query);
                $search = true;
            }

            if ($request->has("area_id") && $request->area_id != null) {
                $query = $areaCriteria->filter($query);
                $search = true;
            }

            if ($request->has("space1") && $request->has("space2") && ($request->space1 != null && $request->space2 != null)) {
                $query = $spaceCriteria->filter($query);
                $search = true;
            }

            if ($request->has("type") && $request->type != null) {
                $query = $typeCriteria->filter($query);
                $search = true;
            }

            if ($request->has("category_id") && $request->category_id != null) {
                $query->where("category_id", $request->category_id);
                $search = true;
            }

            if ($request->has("bedroom_number") && $request->bedroom_number > 0) {
                $query = $bedRoomCriteria->filter($query);
                $search = true;
            }

            if ($request->has("bathroom_number") && $request->bathroom_number > 0) {
                $query = $bathRoomCriteria->filter($query);
                $search = true;
            }

            if ($request->has("finishing_type") && $request->finishing_type != null) {
                $query = $finishTypeCriteria->filter($query);
                $search = true;
            }

            if ($request->has("search") && $request->search) {
                $query = $query->where("title", 'like', "%" . $request->search . "%")->
                        orWhere("description", 'like', "%" . $request->search . "%")->
                        orWhere("finishing_type", 'like', "%" . $request->search . "%")->
                        orWhere("type", 'like', "%" . $request->search . "%")->
                        orWhere("bathroom_number", 'like', "%" . $request->search . "%")->
                        orWhere("bedroom_number", 'like', "%" . $request->search . "%");


                $search = true;
            }

            if ($search)
                $posts = $query->get();

            return Message::success(trans("messages_en.post_found", ["number" => count($posts)]), trans("messages_ar.post_found", ["number" => count($posts)]), $posts);
        } catch (Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    /**
     * get recommended posts
     *
     * @param Request $request
     * @return array $response
     */
    public function getRecommended(Request $request) {
        try {
            // validate the data
            $validator = validator()->make($request->all(), [
//                'price' => 'required',
//                'city_id' => 'required',
//                'finishing_type' => 'required',
            ]);

            if ($validator->fails()) {
                return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
            }

            $plans = Plan::where('recommended_post', '>', 0)->pluck('id')->toArray();
            $companyIds = PlanAssign::whereIn('plan_id', $plans)->whereIn('model_type', ['developer', 'broker'])->pluck('model_id')->toArray();
            $companies = Company::whereIn('id', $companyIds)->get();

            $postsIds = [];
            $posts = [];
            foreach($companies as $company) {
                $userIds = User::where('company_id', $company->id)->pluck('id')->toArray();
                $recommendedPostsIds = Post::query()
                    ->whereIn('user_id', $userIds)
                    ->where("status", "accepted")
                    ->where("show_recommended", "1")
                    ->take(optional($company->plan)->recommended_post)
                    //->orderBy('recommended_sort')
                    ->pluck('id')->toArray();

                foreach($recommendedPostsIds as $post) {
                    $postsIds[] = $post;
                }
            }

            $posts = Post::query()
                        ->whereIn('id', $postsIds)
                        ->orderBy('recommended_sort')
                        ->get();

            return Message::success(trans("messages_en.post_found", ["number" => count($posts)]), trans("messages_ar.post_found", ["number" => count($posts)]), $posts);
        } catch (Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    /**
     * return one post with id
     *
     * @param Request $request
     * @return type
     */
    public function get(Request $request) {
        try {
            // validate the data
            $validator = validator()->make($request->all(), [
                'post_id' => 'required',
            ]);

            if ($validator->fails()) {
                throw new \Exception();
            }

            $post = Post::find($request->post_id);

            throw_if(!$post, new \Exception());
            return Message::success(trans("messages_en.done"), trans("messages_ar.done"), $post);
        } catch (\Exception $e) {
            return Message::error(trans("messages_en.error") . $e->getMessage(), trans("messages_ar.error"));
        }
    }

    /**
     * return one post with id
     *
     * @param Request $request
     * @return type
     */
    public function load(Request $request, Post $post) {
        return $post;
    }

    /**
     * add view for post with mac_address
     *
     * @param Request $request
     * @return type
     */
    public function addView(Request $request) {
        // validate the data
        $validator = validator()->make($request->all(), [
            'mac_address' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Message::error($validator->errors()->first());
        }

        $post = Post::find($request->post_id);

        ($post) ? $post->addView($request->mac_address) : null;

        if (!$post)
            return Message::error(trans("messages_en.forbidden"), trans("messages_ar.forbidden"));

        return Message::success(trans("messages_en.done"), trans("messages_ar.done"));
    }

    /**
     * upload image of the post
     *
     * @param Request $request
     * @return array $response
     */
    public function uploadImage(Request $request) {
        // check if the user login
        $user = User::auth($request);

        if (!$user) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        }

        // validate the data
        $validator = validator()->make($request->all(), [
            'photo' => 'mimes:jpeg,png,bmp,jpg,gif,svg,webp|max:6072', // 3 MB
        ]);

        if ($validator->fails()) {
            return Message::error(trans("messages_en.image_upload_error"), trans("messages_ar.image_upload_error"));
        }

        try {
            $image = $request->id ? Image::find($request->id) : new Image();
            if (!$image) {
                $image = new Image();
            }

            if (!$user->post_id_tmp) {
                $user->post_id_tmp = time();
                $user->update();
            }

            if ($user->post_id_tmp)
                $image->post_id = $user->post_id_tmp;

            if ($request->post_id) {
                $image->post_id = $request->post_id;
            }

            if ($request->has("photo") && $request->photo != null) {
                $photo = Helper::uploadImg($request->file("photo"), "/posts/");
                $image->photo = $photo;

                if ($request->is_360 == 'true' || $request->is_360 == 1)
                    $image->is_360 = 1;

                $image->save();
            }




            return Message::success(trans("messages_en.done"), trans("messages_ar.done"), $image->refresh());
        } catch (Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    /**
     * remove image from uploaded image of post
     *
     * @param Request $request
     * @return array $response
     */
    public function removeImage(Request $request) {
        // check if the user login
        $user = User::auth($request);

        if (!$user) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        }

        // validate the data
        $validator = validator()->make($request->all(), [
            'image_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }

        try {
            $image = Image::find($request->image_id);

            if ($image) {
                // delete old image
                Helper::removeFile(public_path("image/posts") . "/" . $image->photo);
                //
                $image->delete();
            }


            return Message::success(trans("messages_en.done"), trans("messages_ar.done"));
        } catch (\Exception $e) {
            return Message::error(trans("messages_en.error"), trans("messages_ar.error"));
        }
    }

    /**
     * get all image of the post
     *
     * @param Request $request
     * @return array $response
     */
    public function getImages(Request $request) {
        // check if the user login
        $user = User::auth($request);

        if (!$user) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        }

        $images = [];
        $postId = $user->post_id_tmp;

        if ($request->post_id)
            $postId = $request->post_id;

        $images = Image::where('post_id', $postId)->get();

        return Message::success(trans("messages_en.done"), trans("messages_ar.done"), $images);
    }

}
