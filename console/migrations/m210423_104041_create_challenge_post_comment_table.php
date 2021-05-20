<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%challenge_post_comment}}`.
 */
class m210423_104041_create_challenge_post_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge_post_comment}}', [
            'id' => $this->primaryKey(),
            'challenge_post_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->datetime()->defaultvalue(new Expression('NOW()')),
            'updated_at' => $this->datetime()
        ]);

        $this->addForeignKey(
            'fk-challenge_post_comment-challenge_post-challenge_post_id-id',
            'challenge_post_comment',
            'challenge_post_id',
            'challenge_post',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_post_comment-user-user_id-id',
            'challenge_post_comment',
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
        $this->dropTable('{{%challenge_post_comment}}');
    }
}
