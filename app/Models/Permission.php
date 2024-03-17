<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InitialInstance;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug'];
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;

    protected $hidden = ['pivot'];   

    public function __construct()
    {
        $this->initialModel = new InitialInstance();
        $this->initialValues = $this->initialModel->getInitialValues();
        $this->fieldTypes = $this->initialModel->getFieldTypes();
        $this->rules = $this->initialModel->getRules();
        $this->messages = $this->initialModel->getMessages();

    }

    // Initialize your default values in a method if they depend on object state
    public function getRules()
    {
        return $this->rules;
    }

    // Initialize your default values in a method if they depend on object state
    public function fieldTypes()
    {
        return $this->fieldTypes;
    }

    // Initialize your validation messages in a method if they depend on object state
    public function getMessages()
    {
        return $this->messages;
    }

    // Initialize your validation messages in a method if they depend on object state
    public function validationMessages()
    {
        return $this->messages = [
            'data.id.required' => 'The ID field is required.',
            'data.name.string' => 'The name must be a string.',
            'data.name.required' => 'The name field is required.',
            'data.name.max' => 'The name may not be greater than 255 characters.',
            'data.slug.max' => 'The slug may not be greater than 500 characters.',
            'data.slug.required' => 'The slug field is required.',
            'data.slug.regex' => 'The slug must start with a slash (/) and contain no spaces.',
            'data.slug.unique' => 'The slug has already been taken.',
            'data.is_default.boolean' => 'The is_default field must be either true or false.',
            'data.is_system.boolean' => 'The is_system field must be either true or false.',
            'data.is_admin.boolean' => 'The is_admin field must be either true or false.',
            'data.is_public.boolean' => 'The is_public field must be either true or false.',
            'data.is_disabled.boolean' => 'The is_disabled field must be either true or false.',
            'data.is_active.boolean' => 'The is_active field must be either true or false.',
            'data.is_deleted.boolean' => 'The is_deleted field must be either true or false.',
            'data.is_readonly.boolean' => 'The is_readonly field must be either true or false.',
            'data.is_editable.boolean' => 'The is_editable field must be either true or false.',
            'data.is_deletable.boolean' => 'The is_deletable field must be either true or false.',
            'data.is_copyable.boolean' => 'The is_copyable field must be either true or false.',
            'data.is_sortable.boolean' => 'The is_sortable field must be either true or false.',
            'data.is_searchable.boolean' => 'The is_searchable field must be either true or false.',
            'data.is_exportable.boolean' => 'The is_exportable field must be either true or false.',
            'data.is_importable.boolean' => 'The is_importable field must be either true or false.',
            'data.is_printable.boolean' => 'The is_printable field must be either true or false.',
            'data.is_filterable.boolean' => 'The is_filterable field must be either true or false.',
            'data.is_visible.boolean' => 'The is_visible field must be either true or false.',
            'data.is_picklist.boolean' => 'The is_picklist field must be either true or false.',
            'data.is_custom.boolean' => 'The is_custom field must be either true or false.',
            'data.is_pinned.boolean' => 'The is_pinned field must be either true or false.',
            'data.is_movable.boolean' => 'The is_movable field must be either true or false.',
            'data.is_removable.boolean' => 'The is_removable field must be either true or false.',
            'data.is_creatable.boolean' => 'The is_creatable field must be either true or false.',
            'data.is_creatable_by.integer' => 'The is_creatable_by field must be an integer.',
            'data.deleted_at' => 'The deleted_at field is changed by system.',
        ];
    }

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'is_default' => 'boolean',
        'is_system' => 'boolean',
        'is_admin' => 'boolean',
        'is_public' => 'boolean',
        'is_disabled' => 'boolean',
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'is_readonly' => 'boolean',
        'is_editable' => 'boolean',
        'is_deletable' => 'boolean',
        'is_copyable' => 'boolean',
        'is_sortable' => 'boolean',
        'is_searchable' => 'boolean',
        'is_exportable' => 'boolean',
        'is_importable' => 'boolean',
        'is_printable' => 'boolean',
        'is_filterable' => 'boolean',
        'is_visible' => 'boolean',
        'is_picklist' => 'boolean',
        'is_custom' => 'boolean',
        'is_pinned' => 'boolean',
        'is_movable' => 'boolean',
        'is_removable' => 'boolean',
        'is_creatable' => 'boolean',
        'is_creatable_by' => 'integer',
        'deleted_at' => 'datetime',
        'data' => 'array',
        'is_protected' => 'boolean',
        'is_hidden' => 'boolean',
        'is_required' => 'boolean',
        'is_unique' => 'boolean',

    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function getRouteName()
    {
        return 'permissions';
    }

}
