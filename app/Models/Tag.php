<?php

namespace App\Models;

use App\Models\InitialInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public InitialInstance $initialModel;
    public $initialValues;
    public $fieldTypes;
    public $rules;
    public $messages;
    public $tableName;

    protected $fillable = ['name', 'description', 'slug'];

    public function __construct()
    {
        $this->tableName = $this->getTable();

        $this->initialValues = [
            'name' => '',
            'description' => '',
            'slug' => '',
        ];

        $this->fieldTypes = [
            'name' => 'text',
            'description' => 'textarea',
            'slug' => 'text',

        ];

        $this->rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'slug' => 'nullable|string|max:55',
        ];

        $this->messages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'description.nullable' => 'The description field is optional.',
            'description.string' => 'The description field must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'slug.nullable' => 'The slug field is optional.',
            'slug.string' => 'The slug field must be a string.',
            'slug.max' => 'The slug may not be greater than 55 characters.',
        ];

    }
    public function getTable()
    {
        return $this->tableName ?? 'tags';
    }

    // In the Tag model, add a relationship method for articles
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    // In the Tag model, add a relationship method for posts
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
        // Similar to the tags method in the Post model, explicitly define the pivot table name.
    }
}
