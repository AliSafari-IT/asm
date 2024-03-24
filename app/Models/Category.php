<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InitialInstance;

class Category extends Model
{
    use HasFactory;
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;


    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    protected $hidden = ['pivot'];

    public function getInitialValues()
    {
        return $this->initialValues = [
            'name' => '',
            'description' => '',
            'slug' => '',
        ];
    }

    public function getFieldTypes()
    {
        return $this->fieldTypes = [
            'name' => 'text',
            'description' => 'textarea',
            'slug' => 'text',
        ];
    }

    public function getRules()
    {
        return $this->rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'slug' => 'nullable|string|max:55',
        ];
    }

    public function getMessages()
    {
        return $this->messages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'slug.string' => 'The slug must be a string.',
            'slug.max' => 'The slug may not be greater than 55 characters.',
        ];
    }

    public function getTable()
    {
        return $this->tableName ?? 'categories';
    }

    public function __construct()
    {
        $this->tableName = $this->getTable();
        $this->initialValues = $this->getInitialValues();
        $this->fieldTypes = $this->getFieldTypes();
        $this->rules = $this->getRules();
        $this->messages = $this->getMessages();

    }
}
