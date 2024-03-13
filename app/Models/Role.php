<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Validation\Rule;


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
        'is_active'
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

    // customize the validation rules
    public function getRules()
    {
        // customize the validation rules
        $customizedRules = [
            'name' => 'required',
            'description' => 'nullable',
            'slug' => ['required', Rule::unique('permissions', 'slug')->ignore($this->id)],
            'deleted_at' => 'nullable', // assuming it should be a nullable datetime field
            'permissions' => 'nullable',
            'is_default' => 'nullable',
            'is_system' => 'nullable',
            'is_admin' => 'nullable',
            'is_public' => 'nullable',
            'is_disabled' => 'nullable',
            'is_active' => 'nullable',
        ];

        return $customizedRules;
    }

    public function getDefaultData()
    {
        return [
            'name' => '',
            'description' => '',
            'slug' => '',
            'permissions' => [],
            'is_default' => false,
            'is_system' => false,
            'is_admin' => false,
            'is_public' => false,
            'is_disabled' => false,
            'is_active' => true,
        ];
    }

}
