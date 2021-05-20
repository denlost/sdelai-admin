<?php

namespace api\models;

use common\models\Auth;

class User extends \common\models\User
{
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $auth = Auth::findOne(['auth_token' => $token]);
        if ($auth) {
            if ($auth->isExpired()) {
                $auth->delete();
            } else {
                return static::findIdentity($auth->user_id);
            }
        }

        return null;
    }
}