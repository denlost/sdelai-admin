<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\Utility;

/**
 * This is the model class for table "auth".
 *
 * @property int $id
 * @property int $user_id
 * @property string $auth_token
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'auth_token'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['auth_token'], 'string', 'max' => 32],
            [['auth_token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => Utility::getDateNow(),
            ],
        ];
    }

    public function isExpired()
    {
        $timeFrom = $this->updated_at ?: $this->created_at;
        return time() > (strtotime($timeFrom) + Yii::$app->params['authTokenExpire']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'auth_token' => 'Auth Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function generateAuthToken()
    {
        $this->auth_token = Yii::$app->security->generateRandomString();
    }
}
