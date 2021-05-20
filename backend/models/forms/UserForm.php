<?php
namespace backend\models\forms;

use common\models\AuthItem;
use Yii;
use yii\base\Model;
use common\models\User;

class UserForm extends Model
{
    const SCENARIO_CREATE = 'create';

    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    //public $roleName;
    public $status;

    protected $user;

    public function loadFromUser(User $user)
    {
        if (!$user) {
            return;
        }

        $this->user = $user;

        $this->id = $user->id;
        $this->username = $user->username;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        //$this->roleName = $user->getRoleName();
        $this->status = $user->status;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],

            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот логин уже занят',
                'on' => self::SCENARIO_CREATE
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['first_name', 'last_name'], 'string', 'min' => 1, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email уже используется',
                'on' => self::SCENARIO_CREATE
            ],

            [['password'], 'required', 'on' => self::SCENARIO_CREATE],
            ['password', 'string', 'min' => 6],

            ['status', 'in', 'range' => array_keys(User::getStatuses())],
            //['roleName', 'in', 'range' => array_keys(AuthItem::getRoles())],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->user ?: new User();
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->status = $this->status;

        if ($this->password) {
            $user->setPassword($this->password);
        }
        if ($this->scenario == self::SCENARIO_CREATE) {
            $user->generateAuthKey();
        }

        if (!$user->save()) {
            $this->addErrors($user->getErrors());
            return false;
        }

        $this->id = $user->id;

        //$this->assignRole($user, $this->roleName);

        return true;
    }

    /*
    private function assignRole($user, $role)
    {
        $auth = Yii::$app->authManager;
        if (!$auth->getAssignment($role, $user->getId())) {
            $role = $auth->getRole($role);
            $auth->assign($role, $user->getId());
        }
    }
    */

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'E-mail',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'password' => 'Пароль',
            'status' => 'Статус',
            //'roleName' => 'Роль',
        ];
    }
}
