<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models\Admin
 * @version May 8, 2020, 6:19 pm UTC
 *
 * @property string $name
 */
class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function books()
    {
        return $this->hasMany(\App\Models\Book::class, 'category_id');
    }


}
