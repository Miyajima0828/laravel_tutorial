<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Folder extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'folder_id', 'id');
    }

    public function user():HasOne
    {
        return $this->hasOne(User::class);
    }
}
