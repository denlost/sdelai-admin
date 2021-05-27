<?php

use yii\db\Migration;

/**
 * Class m210527_092829_create_user_post_file_tables
 */
class m210527_092829_create_user_post_file_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_post_file', [
            'id' => $this->primaryKey(),
            'user_post_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-user_post_file-user_post_id-user_post',
            'user_post_file',
            'user_post_id',
            'user_post',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_post_file-file_id-file-id',
            'user_post_file',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createTable('user_post_comment_file', [
            'id' => $this->primaryKey(),
            'user_post_comment_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-user_post_comment_file-user_post_comment_id-user_post_comment',
            'user_post_comment_file',
            'user_post_comment_id',
            'user_post_comment',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_post_comment_file-file_id-file-id',
            'user_post_comment_file',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210527_092829_create_user_post_file_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210527_092829_create_user_post_file_tables cannot be reverted.\n";

        return false;
    }
    */
}
