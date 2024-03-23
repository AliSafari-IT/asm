<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    public $tableName;

    public function __construct()
    {
        $this->tableName = $this->getTable();
    }
    public function  getTable() {
        return $this->tableName ?? 'settings';
    }
}
