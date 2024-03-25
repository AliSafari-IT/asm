<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\InitialInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use function PHPUnit\Framework\isNull;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'updated_at', 'created_at'];


    protected $hidden = ['pivot', 'remember_token'];

    public function getInitialsValues()
    {
        $name = "name";
        $psw = null;
        $eml = "asafarim+$name@gmail.com";

        return  $this->initialValues = [
            'name' => $name,
            'email' => $eml,
            'password' => $psw,
            'password_confirm' => $psw,
        ];
    }

    public function getUserFieldTypes()
    {
        return  $this->fieldTypes =[
            'name' => 'text',
            'email' => 'email',
            'password' => 'password',
            'password_confirm' => 'password',

        ];
    }

    public function getUserRules()
    {
        return  $this->rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required',
        ];
    }

    public function getUserRulesMessages()
    {
        return  $this->messages = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required',
            'password_confirm.required' => 'Password confirmation is required',
        ];
    }

    public function  getTable() {
        return $this->tableName ?? 'users';
    }

    public function __construct(
        $initialValues = null,
        $fieldTypes = null,
        $rules = null,
        $messages = null
    )
    {
        $this->initialModel = new InitialInstance($initialValues);
        $this->initialValues = $this->initialModel->initialValues;
        $this->fieldTypes = $this->initialModel->getFieldTypes();
        $this->rules = $this->initialModel->getRules();
        $this->messages = $this->initialModel->getMessages();
        $this->tableName = $this->getTable();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

}
