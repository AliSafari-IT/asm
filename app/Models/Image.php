<?php

namespace App\Models;

use App\Models\InitialInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;

    protected $fillable = [
        'source',
        'alt_text',
        'type',
        'caption',
        'path',
        'dimensions',
    ];

    public function __construct()
    {
        $this->tableName = $this->getTable();

        $this->initialValues = [
            'source' => '',
            'alt_text' => '',
            'type' => '',
            'caption' => '',
            'path' => '',
            'dimensions' => '360x240',
        ];

        $this->fieldTypes = [
            'source' => 'text',
            'alt_text' => 'text',
            'type' => 'text',
            'caption' => 'text',
            'path' => 'text',
            'dimensions' => 'text',

        ];

        $this->rules = [
            'source' => 'required|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
            'path' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',

        ];

        $this->messages = [
            'source.required' => 'The source field is required.',
            'source.string' => 'The source must be a string.',
            'source.max' => 'The source may not be greater than 255 characters.',
            'type.nullable' => 'The type field is optional.',
            'type.string' => 'The type field must be a string.',
            'type.max' => 'The type may not be greater than 255 characters.',          
            'alt_text.nullable' => 'The alt_text field is optional.',
            'alt_text.string' => 'The alt_text field must be a string.',
            'alt_text.max' => 'The alt_text may not be greater than 255 characters.',
            'caption.nullable' => 'The caption field is optional.',
            'caption.string' => 'The caption field must be a string.',
            'caption.max' => 'The caption may not be greater than 255 characters.',
            'path.nullable' => 'The path field is optional.',
            'path.string' => 'The path field must be a string.',
            'path.max' => 'The path may not be greater than 255 characters.',
            'dimensions.nullable' => 'The dimensions field is optional.',
            'dimensions.string' => 'The dimensions field must be a string.',
            'dimensions.max' => 'The dimensions may not be greater than 255 characters.',
        ];
    }

    public function getTable()
    {
        return $this->tableName ?? 'images';
    }

}
