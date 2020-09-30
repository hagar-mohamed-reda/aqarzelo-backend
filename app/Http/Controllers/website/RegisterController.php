<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Helper;
use App\Message;

class RegisterController extends WebsiteController
{

    /**
     * get view of login page
     *
     * @return String html of login.
     */
    public function index() {
        return view($this->prefix . ".register");
    }

    /**
     * create account for user
     *
     * @param Request $request
     */
    public function signUpUser(Request $request) {
        // validate the data
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|size:11|unique:users',
            'password' => 'required|min:8',
        ], [
            "name.required" => trans("messages.please_fill_all_data"),
            "email.required" => trans("messages.please_fill_all_data"),
            "phone.required" => trans("messages.please_fill_all_data"),
            "password.required" =>trans("messages.please_fill_all_data"),
            "email.unique" => trans("messages.email_already_exist"),
            "phone.unique" => trans("messages.phone_already_exist"),
            "password.min" => trans("messages.password_must_be_at_least_8_character"),
        ]);

        if ($validator->fails()) {
            Helper::notify(Message::error($validator->errors()->first()));
            return redirect("/sign-up");
        }

        if ($request->password != $request->password2) {
            Helper::notify(Message::error(trans("words.passwords_not_match")));
            return redirect("/sign-up");
        }

        $data = $request->all();
        $data['active'] = 'active';
        $data['api_token'] = Helper::randamToken();

        $user = User::create($data);
        $user->password = bcrypt($data['password']);
        $user->update();

        session(["user" => $user->id]);
        session(["type" => "USER"]);

        Helper::notify(Message::success(trans("messages.done")));
        return redirect("/sign-up");
    }


    /**
     * create account for company
     *
     * @param Request $request
     */
    public function signUpCompany(Request $request) {
        // validate the data
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            //'commercial_no' => 'required',
            'email' => 'required|email|unique:companies',
            'phone' => 'required|size:11|unique:companies',
            'password' => 'required|min:8',
        ], [
           // "commercial_no.required" => trans("messages.please_fill_all_data"),
            "name.required" => trans("messages.please_fill_all_data"),
            "email.required" => trans("messages.please_fill_all_data"),
            "phone.required" => trans("messages.please_fill_all_data"),
            "password.required" =>trans("messages.please_fill_all_data"),
            "email.unique" => trans("messages.email_already_exist"),
            "phone.unique" => trans("messages.phone_already_exist"),
            "password.min" => trans("messages.password_must_be_at_least_8_character"),
        ]);

        if ($validator->fails()) {
            Helper::notify(Message::error($validator->errors()->first()));
            return redirect("/sign-up");
        }
        $data = $request->all();
        $data['active'] = 'not_active';
        $data['api_token'] = Helper::randamToken();
        $user = Company::create($data);
        $user->password = bcrypt($data['password']);
        $user->update();

        session(["user" => $user->id]);
        session(["type" => "COMPANY"]);

        Helper::notify(Message::success(trans("messages.done")));
        return redirect("/sign-up");
    }
}
