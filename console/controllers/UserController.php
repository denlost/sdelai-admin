<?php
namespace console\controllers;

use common\models\Role;
use common\models\RoleUser;
use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionCreate($username, $phone, $password, $roleCode)
    {
        $uuid = md5($username . $phone . time());

        $user = new User([
            'phone' => $phone,
            'username' => $username,
            'status' => User::STATUS_ACTIVE,
            'first_name' => 'Alex',
            'last_name' => 'Jones',
            'uuid' => $uuid
        ]);

        $user->setPassword($password);

        if (!$user->save()) {
            throw new \Exception('ERROR SAVING NEW USER');
        }

        $roleUser = new RoleUser([
            'user_id' => $user->id,
            'role_id' => Role::getRoleByCode($roleCode)->id
        ]);

        if (!$roleUser->save()) {
            throw new \Exception('ERROR ADDING ROLE TO USER');
        }

        echo "User {$user->username} with role {$roleCode} created" . PHP_EOL;
    }
}