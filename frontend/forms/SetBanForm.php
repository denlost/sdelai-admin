<?php

namespace frontend\forms\army;

use common\models\User;
use common\models\UserBan;
use Yii;
use yii\base\Model;

/*
* @property Army $army
*/
class SetBanForm extends Model
{
    public $error;
    
    public $bantimehrs;

    public $bantimemin;
    
    public $bantimesec;
    
    public $reason;

    private $user;

    public function rules()
    {
        return [
            ['error', 'safe'],
        ];
    }

    public function __construct(User $user, $config = [])
    {
        parent::__construct($config);
        

        $this->user = $user;
    }
    // 'id' => 'ID',
    // 'user_id' => 'ID Пользователя',
    // 'executor_id' => 'ID Забанившего',
    // 'reason_id' => 'Причина',
    // 'date_start' => 'Дата начала',
    // 'date_end' => 'Дата окончания',
    public function save(): bool
    {
        $userban = new UserBan();
        $userban->user_id = $this->user->id;
        $userban->executor_id = Yii::$app->user->getId();
        $userban->reason_id = $this->reason;
        $userban->date_start = date('m/d/Y h:i:s', time());
        $userban->date_end = strtotime("+$this->bantimehrs hours $this->bantimemin minutes +$this->bantimesec seconds");
        if (!$userban->save()) {
            $this->addError('error', print_r($userban->getFirstErrors(), true));
            return false;
        }

        return true;
    }
}