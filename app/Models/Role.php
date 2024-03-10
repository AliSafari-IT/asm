<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'slug',
        'permissions',
        'is_default',
        'is_system',
        'is_admin',
        'is_public',
        'is_disabled',
        'is_deleted',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_ip',
        'updated_ip',
        'deleted_ip',
        'created_at'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = json_encode($value);
    }


    public function getPermissionsAttribute($value)
    {
        return json_decode($value);
    }



    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
