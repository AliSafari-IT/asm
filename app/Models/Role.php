<?php

namespace App\Models;

use App\Models\InitialInstance;
use App\Models\Permission;
use App\Models\User;
use App\Models\Roles\Adminstrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;


class Role extends Model
{
    use HasFactory;
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;

    protected $fillable = [
        'name',
        'description',
    ];
    protected $hidden = ['pivot'];

    public function getInitialValues()
    {
        return $this->initialValues = [
            'name' => '',
            'description' => '',
        ];
    }

    public function getFieldTypes()
    {
        return $this->fieldTypes = [
            'name' => 'text',
            'description' => 'textarea',
        ];
    }

    public function getRules()
    {
        return $this->rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            
        ];
    }

    public function getMessages()
    {
        return $this->messages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'description.nullable' => 'The description field is optional.',
            'description.string' => 'The description field must be a string.',
            'description.max' => 'The description field may not be greater than 1000 characters.',

        ];
    }
    

    public function __construct(
        $initialValues = null,
        $fieldTypes = null,
        $rules = null,
        $messages = null
    ) {
        $this->initialModel = new InitialInstance($initialValues);
        $this->initialValues = $this->initialModel->initialValues;
        $this->fieldTypes = $this->initialModel->getFieldTypes();
        $this->rules = $this->initialModel->getRules();
        $this->messages = $this->initialModel->getMessages();

    }

    public function admins()
    {
        return $this->belongsToMany(Adminstrator::class);
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
