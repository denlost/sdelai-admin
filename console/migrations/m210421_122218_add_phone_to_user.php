<?php

use yii\db\Migration;

/**
 * Class m210421_122218_add_phone_to_user
 */
class m210421_122218_add_phone_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string(32)->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210421_122218_add_phone_to_user cannot be reverted.\n";

        return false;
    }
    */
}
