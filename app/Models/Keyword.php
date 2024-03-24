<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InitialInstance;

class Keyword extends Model
{
    use HasFactory;
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;

    protected $fillable = [
        'keyword',
        'description',
    ];

    public function __construct()
    {
        $this->initialValues = [
            'keyword' => '',
            'description' => '',
        ];

        $this->fieldTypes = [
            'keyword' => 'text',
            'description' => 'textarea',
        ];

        $this->rules = [
            'keyword' => 'required|string|max:50|unique:keywords',
            'description' => 'nullable|string|max:200',
        ];

        $this->messages = [
            'keyword.required' => 'The keyword field is required.',
            'keyword.string' => 'The keyword must be a string.',
            'keyword.max' => 'The keyword may not be greater than 50 characters.',
            'keyword.unique' => 'The keyword has already been taken.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 200 characters.',
        ];

        $this->tableName = $this->getTable();        

    }

    public function getTable()
    {
        return $this->tableName ?? 'keywords';
    }
}
