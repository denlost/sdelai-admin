<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%block_unit}}`.
 */
class m191213_153109_create_block_unit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%block_unit}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'created_at' => $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime(),
            'deleted' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%block_unit}}');
    }
}
