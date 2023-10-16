<?php namespace Leabio\Patient\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'leabio_patient_categories';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
