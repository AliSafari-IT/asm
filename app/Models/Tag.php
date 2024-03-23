<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $tableName;

    public function __construct()
    {
        $this->tableName = $this->getTable();
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
