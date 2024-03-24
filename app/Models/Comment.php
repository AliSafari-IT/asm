<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InitialInstance;

class Comment extends Model
{
    use HasFactory;

    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;

    protected $fillable = ['body', 'parent_id', 'user_id', 'commentable_type', 'commentable_id'];

    public function __construct()
    {
        $this->tableName = $this->getTable();

        $this->initialValues = [
            'body' => '',
            'parent_id' => '',
            'user_id' => '',
            'commentable_type' => '',
            'commentable_id' => '',            
        ];

        $this->fieldTypes = [
            'body' => 'textarea',
            'parent_id' => 'text',
            'user_id' => 'text',
            'commentable_type' => 'text',
            'commentable_id' => 'text',
        ];

        $this->rules = [
            'body' => 'required|string|max:255',
            'parent_id' => 'nullable|string|max:255',
            'user_id' => 'nullable|string|max:255',
            'commentable_type' => 'nullable|string|max:255',
            'commentable_id' => 'nullable|string|max:255',

        ];

        $this->messages = [
            'body.required' => 'The body field is required.',
            'body.string' => 'The body must be a string.',
            'body.max' => 'The body may not be greater than 255 characters.',
            'parent_id.nullable' => 'The parent id field is optional.',
            'parent_id.string' => 'The parent id must be a string.',
            'parent_id.max' => 'The parent id may not be greater than 255 characters.',
            'user_id.nullable' => 'The user id field is optional.',
            'user_id.string' => 'The user id must be a string.',
            'user_id.max' => 'The user id may not be greater than 255 characters.',
            'commentable_type.nullable' => 'The commentable type field is optional.',
            'commentable_type.string' => 'The commentable type must be a string.',
            'commentable_type.max' => 'The commentable type may not be greater than 255 characters.',
            'commentable_id.nullable' => 'The commentable id field is optional.',
            'commentable_id.string' => 'The commentable id must be a string.',
            'commentable_id.max' => 'The commentable id may not be greater than 255 characters.',

        ];              
    }

    
    public function getTable()
    {
        return $this->tableName ?? 'comments';
    }

    // In your Comment model
    public function commentable()
    {
        return $this->morphTo();
    }

}
