<?php

namespace App\Http\Controllers\Api\dashboard\admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Translation;
use DB;

class TranslationController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() { 
        return Translation::get()->pluck('value', 'key');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get() { 
        return Translation::orderBy('word_ar')->latest()->paginate(1000);
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request) {
        try {
            $data = $request->data;//json_decode(); 
            
            foreach($data as $item) {   
                if (isset($item['key'])) {
                    $translation = Translation::where('key', $item['key'])->first();

                    if ($translation) {
                        if (!$request->not_exist) { 
                            $translation->update([ 
                                "word_ar" => $item['word_ar'] . " ",
                                "word_en" => $item['word_en'] . " "
                            ]);
                        }
                    } else { 
                        $translation = Translation::create([
                            "key" => $item['key'],
                            "word_ar" => $item['word_ar'] . " ",
                            "word_en" => $item['word_en'] . " ",
                        ]);
                    }
                }
            }
             
            notfy(__('change translation'), __('change translation'), "fa fa-language"); 
            return responseJson(1, __('proccess has been success')); 
        } catch (Exception $th) {
            return responseJson(0, $th->getMessage()); 
        } 
    }

}
