<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m210526_145417_create_user_post_and_user_post_comment_tables
 */
class m210526_145417_create_user_post_and_user_post_comment_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->string(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()
        ]);

        $this->createTable('user_post_comment', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'user_post_id' => $this->integer()->notNull(),
            'content' => $this->string(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk-user_post-user_id-user-id',
            'user_post',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-user_post_comment-user_id-user-id',
            'user_post_comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-user_post_comment-user_post_id-user_post-id',
            'user_post_comment',
            'user_post_id',
            'user_post',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210526_145417_create_user_post_and_user_post_comment_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210526_145417_create_user_post_and_user_post_comment_tables cannot be reverted.\n";

        return false;
    }
    */
}
