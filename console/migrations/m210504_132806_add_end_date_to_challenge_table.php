<?php

use yii\db\Migration;

/**
 * Class m210504_132806_add_end_date_to_challenge_table
 */
class m210504_132806_add_end_date_to_challenge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('challenge', 'end_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210504_132806_add_end_date_to_challenge_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210504_132806_add_end_date_to_challenge_table cannot be reverted.\n";

        return false;
    }
    */
}
