<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Define the many-to-many relationship with the Article model
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'tagArticle', 'tagsId', 'articleId');
    }
}
