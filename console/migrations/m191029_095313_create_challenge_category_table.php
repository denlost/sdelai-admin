<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challenge_category}}`.
 */
class m191029_095313_create_challenge_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%challenge_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
            'category_type_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk-category_type_id-challenge_category-challenge_category_type',
            'challenge_category',
            'category_type_id',
            'challenge_category_type',
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
            'fk-category_type_id-challenge_category-challenge_category_type',
            'challenge_category'
        );

        $this->dropTable('{{%challenge_category}}');
    }
}
