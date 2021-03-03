<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $table = "permission_groups";
    
    protected $fillable = [
        'name','sort', 'is_admin'
    ];
    
    protected $appends = [
        'can_delete'
    ];
    
    public function getCanDeleteAttribute() {
        return !Permission::where('group_id', $this->id)->exists();
    }
    
    public function permissions() {
        return $this->hasMany(Permission::class, "group_id");//->where('');
    }

    
    public static function roles() {
        return [
            "name" => "required"
        ];
    }
    
}
