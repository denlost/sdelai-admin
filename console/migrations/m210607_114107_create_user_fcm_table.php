<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_fcm}}`.
 */
class m210607_114107_create_user_fcm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_fcm}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()'))
        ]);

        $this->addForeignKey(
            'fk-user_fcm-user_id-user-id',
            'user_fcm',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_fcm}}');
    }
}
