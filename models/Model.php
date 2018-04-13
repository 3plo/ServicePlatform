<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.02.2018
 * Time: 22:53
 */

namespace models;


use models\active_record\ActiveRecord;
use models\helper\validators\ModelValidator;

class Model
{

    /**
     * @var ActiveRecord
     */
    protected $activeRecord;

    /**
     * @var ModelValidator
     */
    protected $validator;

    /**
     * Model constructor.
     * @param ActiveRecord $activeRecord
     */
    public function __construct(ActiveRecord $activeRecord)
    {
        $this->activeRecord = $activeRecord;
    }

    /**
     * @return ActiveRecord
     */
    public function getActiveRecord(): ActiveRecord
    {
        return $this->activeRecord;
    }

    /**
     * @return ModelValidator
     */
    public function getValidator(): ModelValidator
    {
        return $this->validator;
    }
}