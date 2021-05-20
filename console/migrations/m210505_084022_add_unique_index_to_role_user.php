<?php

use yii\db\Migration;

/**
 * Class m210505_084022_add_unique_index_to_role_user
 */
class m210505_084022_add_unique_index_to_role_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-unique-role_user-user_id-role_id',
            'role_user',
            ['user_id', 'role_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210505_084022_add_unique_index_to_role_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210505_084022_add_unique_index_to_role_user cannot be reverted.\n";

        return false;
    }
    */
}
