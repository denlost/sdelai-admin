<?php

use yii\db\Migration;

/**
 * Class m210527_092126_modify_price_column_in_challenge_table
 */
class m210527_092126_modify_price_column_in_challenge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('challenge', 'price', $this->decimal(7, 2)->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210527_092126_modify_price_column_in_challenge_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210527_092126_modify_price_column_in_challenge_table cannot be reverted.\n";

        return false;
    }
    */
}
