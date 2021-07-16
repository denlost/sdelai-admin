<?php

namespace common\exceptions;

use Throwable;

class ModelNotValidException extends \Exception
{
    public function __construct(\yii\base\Model $model, Throwable $previous = null)
    {
        parent::__construct(print_r($model->getFirstErrors(), true), 0, $previous);
    }
}