<?php

namespace App;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    
    
    public static function validators() {
        return [
            "name" => "required",
            "display_name" => "required",
            "group_id" => "required",
        ];
    }
}
