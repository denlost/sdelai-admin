<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%period_type}}`.
 */
class m210504_084844_create_period_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%period_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'code' => $this->string()->notNull()->unique()
        ]);

        $this->renameColumn('challenge_block', 'day_number', 'period_number');

        $this->addColumn('challenge', 'period_type_id', $this->integer());

        $this->addForeignKey(
            'fk-challenge-period_type_id-period_type-id',
            'challenge',
            'period_type_id',
            'period_type',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-challenge-period_type_id-period_type-id',
            'challenge'
        );
        
        $this->dropTable('{{%period_type}}');
    }
}
