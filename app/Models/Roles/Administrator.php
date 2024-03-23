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

    public $tableName;

    public function __construct()
    {
        $this->role = 'Administrator';
        $this->initialModel = new InitialInstance();
        $this->initialValues = $this->initialModel->getInitialValues();
        $this->fieldTypes = $this->initialModel->getFieldTypes();
        $this->rules = $this->initialModel->getRules();
        $this->messages = $this->initialModel->getMessages();
        $this->tableName = $this->getTable();

    }

    public function  getTable() {
        return $this->tableName ?? 'administrators';
    }
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
