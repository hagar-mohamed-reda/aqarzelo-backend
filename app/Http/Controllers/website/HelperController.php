<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request; 
use App\User;
use App\Company;
use App\Helper;
use App\Message;

class HelperController extends WebsiteController
{

    /**
     * get view of login page
     * 
     * @return String html of login.
     */
    public function index() {
        return view($this->prefix . ".help");
    }
 
     
}
