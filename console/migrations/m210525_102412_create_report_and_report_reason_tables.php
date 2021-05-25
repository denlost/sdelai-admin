<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m210525_102412_add_date_reported_column_to_entities
 */
class m210525_102412_create_report_and_report_reason_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('report', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'reason_id' => $this->integer(),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()
        ]);

        $this->createTable('report_reason', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-report-user_id-user-id',
            'report',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-report-reason_id-report_reason-id',
            'report',
            'reason_id',
            'report_reason',
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
            'fk-report-user_id-user-id',
            'report',
        );

        $this->dropForeignKey(
            'fk-report-reason_id-report_reason-id',
            'report',
        );

        $this->dropTable('report_reason');
        $this->dropTable('report');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210525_102412_add_date_blocked_column_to_entities cannot be reverted.\n";

        return false;
    }
    */
}
