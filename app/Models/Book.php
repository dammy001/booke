<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models
 * @version May 12, 2020, 12:39 am UTC
 *
 * @property \App\Models\Category $category
 * @property \App\Models\User $user
 * @property string $title
 * @property string $author
 * @property string $type
 * @property string $pages
 * @property string $description
 * @property string $released
 * @property string $image
 * @property integer $user_id
 * @property integer $category_id
 */
class Book extends Model
{
    use SoftDeletes;

    public $table = 'books';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'author',
        'type',
        'pages',
        'description',
        'released',
        'image',
        'user_id',
        'category_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'author' => 'string',
        'type' => 'string',
        'pages' => 'string',
        'description' => 'string',
        'released' => 'string',
        'image' => 'string',
        'category_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'author' => 'required',
        'type' => 'required',
        'pages' => 'required',
        'description' => 'required',
        'released' => 'required',
        'image' => 'required|mimes:jpeg,png,jpg|max:2048',
        'category_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }

}
