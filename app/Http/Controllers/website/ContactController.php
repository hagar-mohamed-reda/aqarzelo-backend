<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use App\Helper;
use App\Message;
use App\MailBox;

class ContactController extends WebsiteController
{

    /**
     * get view of contact us page
     * 
     * @return String html of contact.
     */
    public function index() {
        return view($this->prefix . ".contact");
    }
    
    
    /**
     * send message to admin company
     * 
     * @param Request $request
     */
    public function sendMessage(Request $request) {
        $data = $request->all();
        $data['user_type'] = 'COMPANY';
        $data['user_id'] = Company::$ADMIN_COMPANY_ID;
        MailBox::create($data);
        
        return Message::success(trans("words.done"));
    }
 
   
}
 