<?php
namespace api\models\forms;

use Yii;
use yii\base\Model;
use api\models\User;

class RegisterForm extends Model
{
    public $email;
    public $first_name;
    public $last_name;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'first_name', 'last_name'], 'trim'],
            [['email', 'first_name', 'last_name'], 'required'],
            ['email', 'email'],
            [['email', 'first_name', 'last_name'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => Yii::t('app', 'User with this email already exists')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User;
        $user->username = md5($this->email);
        $user->email = $this->email;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->setActive();

        if (!$user->save()) {
            throw new \Exception('FAIL saving user');
        }

        //$this->sendEmail($user);

        return true;
    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'first_name' => Yii::t('app', 'Name'),
            'last_name' => Yii::t('app', 'Last name'),
            'password' => Yii::t('app', 'Password'),
        ];
    }
}
