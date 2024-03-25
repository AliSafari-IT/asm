<?php

namespace App\Models;

use App\Models\InitialInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
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
        'images',
        'body',
        'user_id',
        'category_id',
        'docType',
        'published_at',
        'is_published',
        'is_public',
        'created_at',
        'updated_at',
        'keywords',
    ];

    public function __construct()
    {
        $this->initializeModel();
    }

    private function initializeModel()
    {
        $this->initialValues = $this->getInitialValues();
        $this->fieldTypes = $this->getFieldTypes();
        $this->rules = $this->getRules();
        $this->messages = $this->getMessages();
        $this->table = $this->getTable();
    }

    private function getInitialValues()
    {
        return [
            'title' => '',
            'slug' => '',
            'images' => '',
            'body' => '',
            'user_id' => 1,
            'category_id' => 1,
            'doc_type' => 'news',
            'published_at' => \now(),
            'is_published' => 0,
            'is_public' => 1,
            'created_at' => \now(),
            'updated_at' => \now(),
            'keywords' => '',
        ];
    }
           

    public function getFieldTypes()
    {
        return $this->fieldTypes = [
            'title' => 'text',
            'slug' => 'text',
            'images' => 'image[multiple]',
            'body' => 'textarea[rows=10]',
            'user_id' => 'number',
            'category_id' => 'number',
            'docType' => 'text[max=255]',
            'published_at' => 'datetime-local',
            'is_published' => 'checkbox',
            'is_public' => 'checkbox[checked=checked]',
            'created_at' => 'datetime-local[readonly]',
            'updated_at' => 'datetime-local[readonly]',
            'keywords' => 'text[multiple][max=255]',
        ];
    }

    public function getRules()
    {
        return $this->rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'images' => 'required|string|max:255',
            'body' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'docType' => 'required|string|max:255',
            'published_at' => 'required|string|max:255',
            'is_published' => 'required|string|max:255',
            'is_public' => 'required|string|max:255',
            'created_at' => 'required|string|max:255',
            'updated_at' => 'required|string|max:255',
            'keywords' => 'required|string|max:255',
        ];
    }

    public function getMessages()
    {
        return $this->messages = [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'slug.required' => 'The slug field is required.',
            'slug.string' => 'The slug must be a string.',
            'slug.max' => 'The slug may not be greater than 255 characters.',
            'images.required' => 'The images field is required.',
            'images.string' => 'The images must be a string.',
            'images.max' => 'The images may not be greater than 255 characters.',
            'body.required' => 'The body field is required.',
            'body.string' => 'The body must be a string.',
            'body.max' => 'The body may not be greater than 255 characters.',
            'user_id.required' => 'The user_id field is required.',
            'user_id.string' => 'The user_id must be a string.',
            'user_id.max' => 'The user_id may not be greater than 255 characters.',
            'category_id.required' => 'The category_id field is required.',
            'category_id.string' => 'The category_id must be a string.',
            'category_id.max' => 'The category_id may not be greater than 255 characters.',
            'docType.required' => 'The docType field is required.',
            'docType.string' => 'The docType must be a string.',
            'docType.max' => 'The docType may not be greater than 255 characters.',
            'published_at.required' => 'The published_at field is required.',
            'published_at.string' => 'The published_at must be a string.',
            'published_at.max' => 'The published_at may not be greater than 255 characters.',
            'is_published.required' => 'The is_published field is required.',
            'is_published.string' => 'The is_published must be a string.',
            'is_published.max' => 'The is_published may not be greater than 255 characters.',
            'is_public.required' => 'The is_public field is required.',
            'is_public.string' => 'The is_public must be a string.',
            'is_public.max' => 'The is_public may not be greater than 255 characters.',
            'created_at.required' => 'The created_at field is required.',
            'created_at.string' => 'The created_at must be a string.',
            'created_at.max' => 'The created_at may not be greater than 255 characters.',
            'updated_at.required' => 'The updated_at field is required.',
            'updated_at.string' => 'The updated_at must be a string.',
            'updated_at.max' => 'The updated_at may not be greater than 255 characters.',
            'keywords.required' => 'The keywords field is required.',
            'keywords.string' => 'The keywords must be a string.',
            'keywords.max' => 'The keywords may not be greater than 255 characters.',
        ];
    }
    // In the Article model
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

// In your Article model
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

   /**
    * Keywords (a json field of the Article model which stores an array of keyword ids) 
    */
    public function getKeywords()
    {
        return $this->keywords;
    }
}
