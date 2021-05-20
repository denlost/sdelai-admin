<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challenge}}`.
 */
class m191029_100122_create_challenge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull(),
            'description' => $this->text(),

            'creator_id' => $this->integer()->notNull(),

            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),

            'category_id' => $this->integer()->notNull(),

            'duration' => $this->integer()->unsigned(),
            'max_members' => $this->integer()->unsigned(),

            'price' => $this->decimal(2)->unsigned(),

            'start_date' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk-creator_id-challenge-user',
            'challenge',
            'creator_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-category_id-challenge-challenge_category',
            'challenge',
            'category_id',
            'challenge_category',
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
            'fk-creator_id-challenge-user',
            'challenge'
        );

        $this->dropForeignKey(
            'fk-category_id-challenge-challenge_category',
            'challenge'
        );

        $this->dropTable('{{%challenge}}');
    }
}
