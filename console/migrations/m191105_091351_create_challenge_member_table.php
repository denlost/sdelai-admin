<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challenge_member}}`.
 */
class m191105_091351_create_challenge_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge_member}}', [
            'id' => $this->primaryKey(),

            'user_id' => $this->integer()->notNull(),
            'challenge_id' => $this->integer()->notNull(),

            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
        ]);

        $this->createIndex(
            'idx-unique-challenge_member-user_id-challenge_id',
            'challenge_member',
            ['user_id', 'challenge_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-unique-challenge_member-user_id-challenge_id',
            'challenge_member'
        );

        $this->dropTable('{{%challenge_member}}');
    }
}
