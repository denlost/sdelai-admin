<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_ban}}`.
 */
class m210528_124255_create_user_ban_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_ban}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer(),
            'reason_id' => $this->integer(),
            'date_start' => $this->dateTime()->defaultValue(new Expression('NOW()')),
            'date_end' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk-user_ban-user_id-user-id',
            'user_ban',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-user_ban-executor_id-user-id',
            'user_ban',
            'executor_id',
            'user',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-user_ban-reason_id-report_reason-id',
            'user_ban',
            'reason_id',
            'report_reason',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_ban}}');
    }
}
