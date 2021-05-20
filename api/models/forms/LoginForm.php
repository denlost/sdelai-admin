<?php

namespace api\models\forms;

use Yii;
use common\models\Auth;
use yii\base\Model;
use api\models\User;

class LoginForm extends Model
{
    public $email;
    public $password;
    private $_user;

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Не правильная почта или пароль');
            }
        }
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();

            $auth = new Auth;
            $auth->user_id = $user->getId();
            $auth->generateAuthToken();

            if ($auth->save() && Yii::$app->getUser()->login($user)) {
                return [
                    'auth_token' => $auth->auth_token,
                ];
            }
        }

        return null;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }
}
