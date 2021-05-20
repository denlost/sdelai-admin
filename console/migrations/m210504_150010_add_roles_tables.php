<?php

use yii\db\Migration;

/**
 * Class m210504_150010_add_roles_tables
 */
class m210504_150010_add_roles_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'code' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('role_user', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'role_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk-role_user-user_id-user-id',
            'role_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-role_user-role_id-role-id',
            'role_user',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );

        $roles = [
            'Администратор' => 'admin',
            'Модератор' => 'moderator',
            'Пользователь' => 'user'
        ];

        foreach ($roles as $name => $code) {
            $this->insert('role', [
                'name' => $name,
                'code' => $code
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210504_150010_add_roles_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210504_150010_add_roles_tables cannot be reverted.\n";

        return false;
    }
    */
}
