<?php

use yii\db\Migration;

/**
 * Class m210422_081057_remade_email_requirment_in_user
 */
class m210422_081057_remade_email_requirment_in_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'email');
        $this->addColumn('user', 'email', $this->string()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210422_081057_remade_email_requirment_in_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210422_081057_remade_email_requirment_in_user cannot be reverted.\n";

        return false;
    }
    */
}
