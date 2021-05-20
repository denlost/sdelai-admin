<?php

namespace api\models;

class ChallengeCategoryType extends \common\models\ChallengeCategoryType
{
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['created_at'], $fields['updated_at']);

        return $fields;
    }
}