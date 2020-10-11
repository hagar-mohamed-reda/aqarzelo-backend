<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use App\Helper;
use App\Message;

class LoginController extends WebsiteController
{

    /**
     * get view of login page
     *
     * @return String html of login.
     */
    public function index() {
        return view($this->prefix . ".login");
    }


    public function changePasswordPage(Request $request) {
        $user = User::where("verify_code", $request->verify_code)->first();
        if (!$user || strlen($request->verify_code) <= 0)
            return redirect("/login");

        return view($this->prefix . ".change-password", compact("user"));
    }


    /**
     * remove session of user
     * remove session of type
     */
    public function logout() {
        session(["user" => null]);
        session(["type" => null]);
        return redirect('/');
    }

    public function forgetPassword(Request $request) {
        $validator = validator()->make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            Helper::notify(Message::error(trans("messages.email_required")));
            return redirect("/login");
        }

        $type = $request->type;
        $user = null;

        $user = User::where("email", $request->email)->first();



        if ($user) {
                $user->verify_code = Helper::randamToken();
                $user->update();
                $msg = "click the link below to change password <br><br>" . "<a href='".url('/change-password')."?verify_code=".$user->verify_code."' >change pasword link</a>";
                Helper::sendMail($user->email, "forget password", $msg);
                Helper::notify(Message::success(trans("messages.verify_code_send_to_your_email")));
                return back();
        }

        Helper::notify(Message::error(trans("messages.email_not_exist")));
        return back();
    }

    public function changePassword(Request $request) {
        $validator = validator()->make($request->all(), [
            'verify_code' => 'required',
            'password' => 'required|min:8',
        ], [
            "verify_code.required" => trans("messages.please_fill_all_data"),
            "password.required" =>trans("messages.please_fill_all_data"),
            "password.min" => trans("messages.password_must_be_at_least_8_character"),
        ]);

        if ($validator->fails()) {
            Helper::notify(Message::error($validator->errors()->first()));
            return back();
        }

        if ($request->password != $request->password2) {
            Helper::notify(Message::error(trans("words.passwords_not_match")));
            return back();
        }

        $user = null;

        $user = User::where("verify_code", $request->email)->first();



        if ($user) {
                $user->password = Hash::make($request->password);
                $user->update();
                Helper::notify(Message::success(trans("messages.done")));
                return back();
        }

        Helper::notify(Message::error(trans("messages.error")));
        return back();
    }
    /**
     * sign in to website
     * create user id session
     *
     * @param Request $request
     */
    public function signIn(Request $request) {
        $validator = validator()->make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            Helper::notify(Message::error(trans("messages.type_required")));
            return redirect("/login");
        }

        $type = $request->type;
        $user = null;

        if ($type == "USER") {
            $user = User::where("phone", $request->email)->orWhere("email", $request->email)->first();
        } else if ($type == "COMPANY") {
            $user = Company::where("email", $request->email)->first();
        }


        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                if (!$user->isActive()) {
                    Helper::notify(Message::error(trans("messages.account_not_active")));
                    return redirect("/login");
                }

                session(["user" => $user->id]);
                session(["type" => $type]);

                $user->api_token = Helper::randamToken();
                $user->update();

                Helper::notify(Message::success(trans("messages.done")));
                return redirect("/profile");
            }
        }

        Helper::notify(Message::error(trans("messages.email_or_password_error")));
        return redirect("/profile");
    }
}
