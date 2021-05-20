<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m210511_140800_create_files_tables
 */
class m210511_140800_create_files_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'filepath' => $this->string()->notNull()->unique(),
            'filetype' => $this->string(6)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()'))
        ]);

        $this->createTable('user_file', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-user_file-user_id-user-id',
            'user_file',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_file-file_id-file-id',
            'user_file',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createTable('challenge_post_file', [
            'id' => $this->primaryKey(),
            'challenge_post_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-challenge_post_file-challenge_post_id-challenge_post',
            'challenge_post_file',
            'challenge_post_id',
            'challenge_post',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_post_file-file_id-file-id',
            'challenge_post_file',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createTable('challenge_post_comment_file', [
            'id' => $this->primaryKey(),
            'challenge_post_comment_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-challenge_post_comment_file-challenge_post_comment_id-challenge_post_comment',
            'challenge_post_comment_file',
            'challenge_post_comment_id',
            'challenge_post_comment',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_post_comment_file-file_id-file-id',
            'challenge_post_comment_file',
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
        echo "m210511_140800_create_files_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210511_140800_create_files_tables cannot be reverted.\n";

        return false;
    }
    */
}
