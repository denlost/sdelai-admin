<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challenge_block_result}}`.
 */
class m191213_154526_create_challenge_block_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge_block_result}}', [
            'id' => $this->primaryKey(),
            'challenge_block_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'repetitions' => $this->integer()->unsigned(),
            'comment' => $this->text(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
        ]);

        $this->createIndex(
            'idx-unique-challenge_block_result-challenge_block_id-user_id',
            'challenge_block_result',
            ['challenge_block_id', 'user_id'],
            true
        );

        $this->addForeignKey(
            'fk-challenge_block_result-challenge_block-challenge_block_id-id',
            'challenge_block_result',
            'challenge_block_id',
            'challenge_block',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_block_result-user-user_id-id',
            'challenge_block_result',
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
        $this->dropForeignKey(
            'fk-challenge_block_result-challenge_block-challenge_block_id-id',
            'challenge_block_result'
        );

        $this->dropForeignKey(
            'fk-challenge_block_result-user-user_id-id',
            'challenge_block_result'
        );

        $this->dropIndex(
            'idx-unique-challenge_block_result-challenge_block_id-user_id',
            'challenge_block_result'
        );

        $this->dropTable('{{%challenge_block_result}}');
    }
}
