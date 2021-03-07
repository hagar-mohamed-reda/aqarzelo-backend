<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Helper;
use App\Message;
use App\Plan;
use App\PlanAssign;

class RegisterController extends WebsiteController
{

    /**
     * get view of login page
     *
     * @return String html of login.
     */
    public function index() {
        $plans = Plan::where('model_type', 'agent')->get();
        return view($this->prefix . ".register", compact("plans"));
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
            'phone' => 'required|unique:users',
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

        if ($request->model_type != 'company') {
            $user = User::create($data);
            $user->password = bcrypt($data['password']);
            $user->update();

            if ($request->plan_id > 0) {
                PlanAssign::create([
                    "plan_id" => $request->plan_id,
                    "model_type" => $request->model_type,
                    "model_id" => $user->id,
                    "date" => date('Y-m-d')
                ]);
            }

            session(["user" => $user->id]);
            session(["type" => "USER"]);

            Helper::notify(Message::success(trans("messages.done")));
            return redirect("/profile");
        } else {
            $data['active'] = "not_active";
            $user = Company::create($data);

            Helper::notify(Message::success(trans("messages.done")));
            return back();
        }

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
        return redirect("/profile");
    }
}
