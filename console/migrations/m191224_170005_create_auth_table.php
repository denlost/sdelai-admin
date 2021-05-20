<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth}}`.
 */
class m191224_170005_create_auth_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'auth_token' => $this->string(32)->unique()->notNull(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-auth-user-user_id-id',
            'auth',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
           'idx-auth-auth_token',
           'auth',
           'auth_token',
           true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-auth-user-user_id-id',
            'auth'
        );

        $this->dropIndex(
            'idx-auth-auth_token',
            'auth'
        );

        $this->dropTable('{{%auth}}');
    }
}
