<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Image
 * @package App\Models
 * @version May 12, 2020, 2:07 am UTC
 *
 * @property string $id
 * @property string $imageable_type
 * @property integer $imageable_id
 * @property string $image
 */
class Image extends Model
{
    use SoftDeletes;

    public $table = 'images';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'imageable_type',
        'imageable_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'imageable_type' => 'string',
        'imageable_id' => 'integer',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }


}
