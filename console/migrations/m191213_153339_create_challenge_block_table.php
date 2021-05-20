<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challenge_block}}`.
 */
class m191213_153339_create_challenge_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge_block}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'unit_id' => $this->integer()->notNull(),
            'repetitions' => $this->integer()->unsigned()->notNull(),
            'comment' => $this->text(),
            'order' => $this->integer()->unsigned()->notNull(),
            'day_number' => $this->integer()->unsigned()->notNull(),
            'challenge_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
        ]);

        $this->createIndex(
            'idx-unique-challenge_block-challenge_id-day_number-order',
            'challenge_block',
            ['challenge_id', 'day_number', 'order'],
            true
        );

        $this->addForeignKey(
            'fk-challenge_block-unit_id-block_unit-id',
            'challenge_block',
            'unit_id',
            'block_unit',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_block-challenge_id-challenge-id',
            'challenge_block',
            'challenge_id',
            'challenge',
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
            'fk-challenge_block-unit_id-block_unit-id',
            'challenge_block'
        );

        $this->dropForeignKey(
            'fk-challenge_block-challenge_id-challenge-id',
            'challenge_block'
        );

        $this->dropIndex(
            'idx-unique-challenge_block-challenge_id-day_number-order',
            'challenge_block'
        );


        $this->dropTable('{{%challenge_block}}');
    }
}
