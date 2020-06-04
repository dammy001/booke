<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use softDeletes;

    protected $table = "libraries";

    protected $fillable = [
        'book_id', 'user_id', 'title', 'image'
    ];

    protected $hidden = ['updated_at'];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }
}
