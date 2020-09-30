<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request; 

class HomeController extends WebsiteController
{
    
    /**
     * get view of index page
     * 
     * @return String html of index.
     */
    public function index() {
        return view($this->prefix . ".home");
    }
    
}
