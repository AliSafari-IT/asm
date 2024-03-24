<?php

namespace App\Models;

use App\Models\InitialInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;


    protected $fillable = [
        'title',
        'slug',
        'image',
        'body',
        'category_id',
        'user_id',
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_published',
        'is_deleted',
        'is_draft',
        'keywords',
    ];

    public function getInitialValues()
    {
        return $this->initialValues = [
            'title' => '',
            'slug' => '',
            'image' => '',
            'body' => '',
            'category_id' => '',
            'user_id' => '',
            'published_at' => '',
            'created_at' => '',
            'updated_at' => '',
            'deleted_at' => '',
            'is_published' => '',
            'is_deleted' => '',
            'is_draft' => '',
            'keywords' => '',
        ];
    }

    public function getFieldTypes()
    {
        return $this->fieldTypes = [
            'title' => 'text',
            'slug' => 'text',
            'image' => 'text',
            'body' => 'textarea',
            'category_id' => 'select',
            'user_id' => 'select',
            'published_at' => 'date',
            'created_at' => 'date',
            'updated_at' => 'date',
            'deleted_at' => 'date',
            'is_published' => 'checkbox',
            'is_deleted' => 'checkbox',
            'is_draft' => 'checkbox',
            'keywords' => 'text',
        ];
    }

    public function getRules()
    {
        return $this->rules = [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'body' => 'nullable|string|max:65535',
            'category_id' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'is_deleted' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'keywords' => 'nullable|string|max:255',
        ];
    }

    public function getMessages()
    {
        return $this->messages = [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field may not be greater than 255 characters.',
            'slug.nullable' => 'The slug field is optional.',
            'slug.string' => 'The slug field must be a string.',
            'slug.max' => 'The slug field may not be greater than 255 characters.',
            'image.nullable' => 'The image field is optional.',
            'body.nullable' => 'The body field is optional.',
            'body.string' => 'The body field must be a string.',
            'body.max' => 'The body field may not be greater than 65535 characters.',
            'category_id.nullable' => 'The category id field is optional.',
            'category_id.integer' => 'The category id field must be an integer.',
            'user_id.nullable' => 'The user id field is optional.',
            'user_id.integer' => 'The user id field must be an integer.',
            'published_at.nullable' => 'The published at field is optional.',
            'published_at.date' => 'The published at field must be a date.',
            'created_at.nullable' => 'The created at field is optional.',
            'created_at.date' => 'The created at field must be a date.',
            'updated_at.nullable' => 'The updated at field is optional.',
            'updated_at.date' => 'The updated at field must be a date.',
            'deleted_at.nullable' => 'The deleted at field is optional.',
            'deleted_at.date' => 'The deleted at field must be a date.',
            'is_published.nullable' => 'The is published field is optional.',
            'is_published.boolean' => 'The is published field must be a boolean.',
            'is_deleted.nullable' => 'The is deleted field is optional.',
            'is_deleted.boolean' => 'The is deleted field must be a boolean.',
            'is_draft.nullable' => 'The is draft field is optional.',
            'is_draft.boolean' => 'The is draft field must be a boolean.',
            'keywords.nullable' => 'The keywords field is optional.',
        ];
    }

    public function getTable()
    {
        return $this->tableName ?? 'posts';
    }

    public function __construct()
    {
        $this->initialModel = new InitialInstance();
        $this->initialValues = $this->initialModel->getInitialValues();
        $this->fieldTypes = $this->initialModel->getFieldTypes();
        $this->rules = $this->initialModel->getRules();
        $this->messages = $this->initialModel->getMessages();
        $this->tableName = $this->getTable();

    }

    // In the Post model
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
        // The second parameter 'post_tag' is the table name, explicitly defined
        // since Laravel might not automatically infer the correct pivot table name.
    }

    // In your Post model
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Keywords (a json field of the Post model which stores an array of keyword ids)
     * */
    public function getKeywords()
    {
        return $this->keywords;
    }

}
