<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Specify the table if it's not the pluralized form of the model name
    // protected $table = 'permissions';

    // Mass assignable attributes
    protected $fillable = ['name', 'description'];

    // Optionally, if your permissions are related to roles in a many-to-many relationship
    // you might have a Role model and define a relationship in both models

    /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function getRouteName() {
        return 'permissions';
    }
}
