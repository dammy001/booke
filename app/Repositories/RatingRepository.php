<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Repositories\BaseRepository;

/**
 * Class RatingRepository
 * @package App\Repositories
 * @version June 4, 2020, 7:34 pm UTC
*/

class RatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rating::class;
    }
}
