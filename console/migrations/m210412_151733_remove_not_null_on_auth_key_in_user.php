<?php

use yii\db\Migration;

/**
 * Class m210412_151733_remove_not_null_on_auth_key_in_user
 */
class m210412_151733_remove_not_null_on_auth_key_in_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            'user',
            'auth_key',
            $this->string(32)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210412_151733_remove_not_null_on_auth_key_in_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210412_151733_remove_not_null_on_auth_key_in_user cannot be reverted.\n";

        return false;
    }
    */
}
