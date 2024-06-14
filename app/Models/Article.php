<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title', 'description', 'categorieId', 'usersId'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'articlesId');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categorieId');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tagArticle', 'articleId', 'tagsId');
    }
}
