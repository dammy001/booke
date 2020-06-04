<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App\Models
 * @version June 4, 2020, 7:07 pm UTC
 *
 */
class Comment extends Model
{
    use SoftDeletes;

    public $table = 'comments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'commentable_id', 'commentable_type', 'user_id', 'message'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at', 'commentable_id', 'commentable_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
