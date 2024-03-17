<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class InitialInstance extends Model
{
    use HasFactory;

    protected $initialValues;
    protected $fieldTypes;
    protected $rules;
    protected $messages;

    public function __construct(
        $initialValues = null,
        $fieldTypes = null,
        $rules = null,
        $messages = null
    ) {
        $this->initialValues = $initialValues ?? $this->getInitialValues();
        $this->fieldTypes = $fieldTypes ?? $this->getFieldTypes();
        $this->rules = $rules ?? $this->getRules();
        $this->messages = $messages ?? $this->getMessages();
    }

    public function getInitialValues()
    {
        return $this->initialValues ?? [
            'name' => '',
            'description' => null,
            'slug' => '/',
            'deleted_at' => null,
            'is_default' => false,
            'is_system' => false,
            'is_admin' => false,
            'is_public' => true,
            'is_disabled' => false,
            'is_active' => true,
            'is_deleted' => false,
            'is_readonly' => false,
            'is_editable' => true,
            'is_deletable' => true,
            'is_copyable' => true,
            'is_sortable' => true,
            'is_searchable' => true,
            'is_exportable' => true,
            'is_importable' => true,
            'is_printable' => true,
            'is_filterable' => true,
            'is_visible' => true,
            'is_picklist' => false,
            'is_custom' => false,
            'is_pinned' => false,
            'is_movable' => false,
            'is_removable' => false,
            'is_creatable' => false,
            'is_updatable' => false,

            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'role_id' => null,
            'permission_id' => null,
            'username' => '',

        ];
    }

    public function getFieldTypes()
    {
        return [
            'name' => 'text',
            'description' => 'textarea',
            'slug' => 'text',
            'is_default' => 'checkbox',
            'is_system' => 'checkbox',
            'is_admin' => 'checkbox',
            'is_public' => 'checkbox',
            'is_disabled' => 'checkbox',
            'is_active' => 'checkbox',
            'is_deleted' => 'checkbox',
            'is_readonly' => 'checkbox',
            'is_editable' => 'checkbox',
            'is_deletable' => 'checkbox',
            'is_copyable' => 'checkbox',
            'is_sortable' => 'checkbox',
            'is_searchable' => 'checkbox',
            'is_exportable' => 'checkbox',
            'is_importable' => 'checkbox',
            'is_printable' => 'checkbox',
            'is_filterable' => 'checkbox',
            'is_visible' => 'checkbox',
            'is_picklist' => 'checkbox',
            'is_custom' => 'checkbox',
            'is_pinned' => 'checkbox',
            'is_movable' => 'checkbox',
            'is_removable' => 'checkbox',
            'is_creatable' => 'checkbox',
            'is_updatable' => 'checkbox',
            'email' => 'text',
            'password' => 'text',
            'password_confirmation' => 'text',
            'role_ids' => 'array',
            'username' => 'text',

        ];
    }

    // getMessages
    public function getMessages()
    {
        return [
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
            'data.description.string' => 'The description must be a string.',
            'data.description.max' => 'The description may not be greater than 2500 characters.',
            'data.username.string' => 'The username must be a string.',
            'data.username.max' => 'The username may not be greater than 100 characters.',
            'data.username.required' => 'The username field is required.',
            'data.username.unique' => 'The username has already been taken.',
            'data.email.string' => 'The email must be a string.',
            'data.email.max' => 'The email may not be greater than 255 characters.',
            'data.email.required' => 'The email field is required.',
            'data.email.unique' => 'The email has already been taken.',
            'data.email.email' => 'The email must be a valid email address.',
            'data.password.string' => 'The password must be a string.',
            'data.password.max' => 'The password may not be greater than 255 characters.',
            'data.password.required' => 'The password field is required.',
            'data.password.confirmed' => 'The password confirmation does not match.',
            'data.password_confirmation.string' => 'The password confirmation must be a string.',
            'data.password_confirmation.max' => 'The password confirmation may not be greater than 255 characters.',
            'data.password_confirmation.required' => 'The password confirmation field is required.',
            'data.password_confirmation.confirmed' => 'The password confirmation does not match.',
            'data.roles.required' => 'The roles field is required.',

        ];
    }

    public function getTableAttribute($value)
    {
        return json_decode($value);
    }

    // customize the validation rules
    public function getRules()
    {
        // customize the validation rules
        return [
            'data.name' => ['required', 'string', 'max:255'],
            'data.description' => ['nullable', 'max:2500'],
            'data.slug' => [
                'required',
                'regex:/^\/.+$/',
                Rule::unique('permissions', 'slug')->ignore($this->id),
            ],
            'data.deleted_at' => ['nullable'],
            'data.username' => ['required', 'string', 'max:100'],
            'data.email' => ['required', 'string', 'max:255', 'email', Rule::unique('users', 'email')->ignore($this->id)],
            'data.password' => ['required', 'string', 'max:255'],
            'data.password_confirmation' => ['required', 'string', 'max:255'],
            'data.roles' => ['required'],

        ];
    }

}