<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challenge_post}}`.
 */
class m191213_155209_create_challenge_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge_post}}', [
            'id' => $this->primaryKey(),
            'challenge_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk-challenge_post-challenge-challenge_id-id',
            'challenge_post',
            'challenge_id',
            'challenge',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_post-user-user_id-id',
            'challenge_post',
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
        $this->dropTable('{{%challenge_post}}');
    }
}
