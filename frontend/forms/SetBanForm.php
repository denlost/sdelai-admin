<?php

namespace frontend\forms;

use common\exceptions\ModelNotValidException;
use common\models\ReportReason;
use common\models\UserBan;
use Yii;
use yii\base\Model;

class SetBanForm extends Model
{
    private $instance;

    public $days;
    public $hours;
    public $minutes;
    public $reason_code;

    public function rules()
    {
        return [
            [['days', 'hours', 'minutes'], 'integer'],
            ['reason_code', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'days' => 'Дни',
            'hours' => 'Часы',
            'minutes' => 'Минуты',
            'reason_code' => 'Причина',
        ];
    }

    public function __construct($instance, $config = [])
    {
        parent::__construct($config);

        $this->instance = $instance;
    }

    public function save()
    {
        $reason = new ReportReason();
        $reason->name = "reason for ban";
        $reason->code = $this->reason_code;
        $reason->save();

        $entry = new UserBan();

        $entry->executor_id = Yii::$app->user->id;
        $entry->user_id = $this->instance->id;
        $entry->reason_id = $reason->id;

        if (!$entry->save())
            throw new ModelNotValidException($entry);

        return true;
    }
}