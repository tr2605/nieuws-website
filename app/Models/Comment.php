<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id', 'article_id', // Adjusted field names
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usersid'); // Specify the foreign key column
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'articlesId'); // Specify the foreign key column
    }
}
