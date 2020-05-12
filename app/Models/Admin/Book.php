<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models\Admin
 * @version May 8, 2020, 3:55 pm UTC
 *
 * @property string $title
 * @property string $author
 * @property string $type
 * @property string $pages
 * @property string $description
 * @property string $released
 */
class Book extends Model
{
    use SoftDeletes;

    public $table = 'books';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'user_id',
        'category_id',
        'author',
        'type',
        'pages',
        'description',
        'released',
        'image'
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
        'image' => 'string'
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
        'image' => 'required'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category', 'category_id');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

}
