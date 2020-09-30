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
 
    
    /**
     * remove session of user
     * remove session of type
     */
    public function logout() {
        session(["user" => null]);
        session(["type" => null]);
        return redirect('/');
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
