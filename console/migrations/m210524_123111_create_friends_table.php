<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_friends}}`.
 */
class m210524_123111_create_friends_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_friend', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'friend_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()'))
        ]);

        $this->createIndex(
            'idx-user_friend-user_id-friend_id',
            'user_friend',
            ['user_id', 'friend_id'],
            true
        );

        $this->addForeignKey(
            'fk-user_friend-user_id-user-id',
            'user_friend',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_friend-friend_id-user-id',
            'user_friend',
            'friend_id',
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
        $this->dropIndex(
            'idx-user_friend-user_id-friend_id',
            'user_friend',
        );
        $this->dropForeignKey(
            'fk-user_friend-friend_id-user-id',
            'user_friend',
        );
        $this->dropForeignKey(
            'fk-user_friend-user_id-user-id',
            'user_friend',
        );
        $this->dropTable('{{%friends}}');
    }
}
