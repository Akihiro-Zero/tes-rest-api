<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
