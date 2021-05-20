<?php

use yii\db\Migration;

/**
 * Class m191119_212850_change_date_types_user_table
 */
class m191119_212850_change_date_types_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('user', 'created_at');
        $this->dropColumn('user', 'updated_at');

        $this->addColumn('user', 'created_at', $this->datetime()->defaultValue(new \yii\db\Expression('NOW()')));
        $this->addColumn('user', 'updated_at', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191119_212850_change_date_types_user_table cannot be reverted.\n";

        return false;
    }
    */
}
