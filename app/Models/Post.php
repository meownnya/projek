<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'music',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


    public function folders()
    {
        return $this->belongsToMany(Folder::class, 'folder_post');
    }
}
