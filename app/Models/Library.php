<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use softDeletes;

    protected $table = "libraries";

    protected $fillable = [
        'book_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }
}
