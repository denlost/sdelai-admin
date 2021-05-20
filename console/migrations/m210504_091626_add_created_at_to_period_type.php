<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m210504_091626_add_created_at_to_period_type
 */
class m210504_091626_add_created_at_to_period_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'period_type',
            'created_at',
            $this->dateTime()->defaultValue(new Expression('NOW()'))
        );

        $this->addColumn(
            'period_type',
            'updated_at',
            $this->dateTime()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210504_091626_add_created_at_to_period_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210504_091626_add_created_at_to_period_type cannot be reverted.\n";

        return false;
    }
    */
}
