<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if($value)
            return asset('storage/'.$value);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function comments()
    {
        //Article has many comments
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        //article creator
        return $this->belongsTo(User::class);
    }
}
