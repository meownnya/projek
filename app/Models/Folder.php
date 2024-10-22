<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'folder_post');
    }
}
