<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Profile;
use App\Message;
use App\Helper;

class ProfileController extends WebsiteController
{

    /**
     * get view of profile page
     * 
     * @return String html of login.
     */
    public function index() {
        $profile = new Profile(Profile::auth());
        return view($this->prefix . ".profile", compact("profile"));
    }

    /**
     * update profile photo for user or company
     * 
     * @param Request $request 
     */
    public function updateImage(Request $request) {
        $user = Profile::auth();
        $path = session("type") == "USER"? "/users" : "/companys";
       
        if ($request->has("photo") && $request->photo != null) {
            // remove old image
            Helper::removeFile(public_path() . "/images/users/" . $user->photo);
            $user->photo = Helper::uploadImg($request->photo, $path);
            $user->update();
        }
        
        return Message::success(trans("messages.done"));
    }

    /**
     * update cover image of usr or company
     * 
     * @param Request $request 
     */
    public function updateCover(Request $request) {
        $user = Profile::auth();
        $path = session("type") == "USER"? "/users" : "/companys";
       
        if ($request->has("cover") && $request->cover != null) {
            // remove old image
            Helper::removeFile(public_path() . "/images/users/" . $user->cover);
            $user->cover = Helper::uploadImg($request->cover, $path);
            $user->update();
        }
        
        return Message::success(trans("messages.done"));
    }

    /**
     * update profile of user or company
     * 
     * @param Request $request 
     */
    public function update(Request $request) {
        if (session("type") == "USER")
            return $this->updateUserProfile($request);
        else if (session("type") == "COMPANY")
            return $this->updateCompanyProfile($request);

        return Message::error(trans("messages.error"));
    }

    /**
     * update profile of user
     * 
     * @param Request $request 
     */
    public function updateUserProfile(Request $request) {
        $user = Profile::auth();
        $data = json_decode($request->profile, true);

        $validator = validator()->make($data, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
                ], [
            "name.required" => trans("messages.please_fill_all_data"),
            "email.required" => trans("messages.please_fill_all_data"),
            "phone.required" => trans("messages.please_fill_all_data"),
        ]);

        if ($validator->fails()) {
            return Message::error($validator->errors()->first());
        }

        // check on email if exist
        if ($user->email != $data['email'] && User::where("email", $data['email'])->count() > 0)
            Message::error(trans("messages.email_already_exist"));

        // check on phone if exist
        if ($user->phone != $data['phone'] && User::where("phone", $data['phone'])->count() > 0)
            Message::error(trans("messages.phone_already_exist"));

        $user->update($data);

        if (isset($data['password']))
            $user->update(["password" => bcrypt($data['password'])]);

        return Message::success(trans("messages.done"));
    }

    /**
     * update profile of user
     * 
     * @param Request $request 
     */
    public function updateCompanyProfile(Request $request) {
        $user = Profile::auth();
        $data = json_decode($request->profile, true);

        $validator = validator()->make($data, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
                ], [
            "name.required" => trans("messages.please_fill_all_data"),
            "email.required" => trans("messages.please_fill_all_data"),
            "phone.required" => trans("messages.please_fill_all_data"),
        ]);

        if ($validator->fails()) {
            return Message::error($validator->errors()->first());
        }

        // check on email if exist
        if ($user->email != $data['email'] && Company::where("email", $data['email'])->count() > 0)
            Message::error(trans("messages.email_already_exist"));

        // check on phone if exist
        if ($user->phone != $data['phone'] && Company::where("phone", $data['phone'])->count() > 0)
            Message::error(trans("messages.phone_already_exist"));


        $user->update($data);

        if (isset($data['password']))
            $user->update(["password" => bcrypt($data['password'])]);

        Message::success(trans("messages.done"));
    }
}
