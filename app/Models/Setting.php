<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InitialInstance;

class Setting extends Model
{
    use HasFactory;
    
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;

    protected $fillable = [
        'key',
        'value',
    ];

    public function __construct()
    {
        $this->tableName = $this->getTable();
        $this->initialValues = [
            'key' => '',
            'value' => '',
        ];
        $this->fieldTypes = [
            'key' => 'text',
            'value' => 'textarea',
        ];
        $this->rules = [
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ];
        $this->messages = [
            'key.required' => 'The key field is required.',
            'key.string' => 'The key must be a string.',
            'key.max' => 'The key may not be greater than 255 characters.',
            'value.required' => 'The value field is required.',
            'value.string' => 'The value must be a string.',
            'value.max' => 'The value may not be greater than 255 characters.',

        ];        
    }

    public function  getTable() {
        return $this->tableName ?? 'settings';
    }

    
}
