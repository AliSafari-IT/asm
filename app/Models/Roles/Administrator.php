<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Administrator extends Model
{
    use HasFactory;
    public $username;
    public $email;
    public $role = 'Administrator';

    public function addUser($user)
    {
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function deleteUserAdminRole ($user)
    {
        $user->roles()->detach($this->id);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
