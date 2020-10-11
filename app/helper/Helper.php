<?php

namespace App\helper;

use App\Message;

class Helper
{



    public static function removeFile($filename)
    {
        try {
            unlink($filename);
            return true;
        } catch (\Exception $exc) {
            return false;
        }
    }


    /**
     *  function to send  mobile sms to user
     * @param type $message
     * @param type $phone
     * @return type
     */



    //////// function for saving images and icons to public path /////////
    ///// run like this  save_file($request->image, '/path_name');
    public static function uploadImg($file, $folder = '/')
    {
        $extension = $file->getClientOriginalExtension(); // getting image extension
        //
        //        if (!self::validateExtension($extension))
        //            return Message::$REQUIRED_IMAGE;

        $filename = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $dest = public_path('/images' . $folder);
        $file->move($dest, $filename);
        // return 'public/uploads' . $folder . '/' . $fileName;

        return $filename;
    }


    public static function uploadFile($file, $folder = '/')
    {
        $extension = $file->getClientOriginalExtension(); // getting image extension
        //
        //        if (!self::validateExtension($extension))
        //            return Message::$REQUIRED_IMAGE;

        $filename = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $dest = public_path('/file' . $folder);
        $file->move($dest, $filename);
        // return 'public/uploads' . $folder . '/' . $fileName;

        return $filename;
    }

    public static function sendMail($to, $message, $subject)
    {

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($message,70);

        $msg = str_replace('\n', "", $msg);

        $sentMessage = "from : info@aqarzelo.com" . "<br>" . $msg;

        // send email
        mail($to,$subject,$sentMessage);
    }

    /**
     * prepare objects based on getJson function in model
     *
     * @param type $data
     * @return type
     */
}
