<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if($value)
            return asset('storage/'.$value);
    }

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
