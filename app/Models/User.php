<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\InitialInstance;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;

    protected $hidden = ['pivot', 'password', 'remember_token'];   

    public function __construct()
    {
        $this->initialModel = new InitialInstance();
        $this->initialValues = $this->initialModel->getInitialValues();
        $this->fieldTypes = $this->initialModel->getFieldTypes();
        $this->rules = $this->initialModel->getRules();
        $this->messages = $this->initialModel->getMessages();

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirm',
    ];

    public function getInitialsValues()
    {
        $name = "name";
        $psw = null;
        $eml = "asafarim+$name@gmail.com";

        return [
            'name' => $name,
            'email' => $eml,
            'password' => $psw,
        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

}