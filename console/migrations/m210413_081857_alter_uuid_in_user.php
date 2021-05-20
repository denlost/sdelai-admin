<?php

use yii\db\Migration;

/**
 * Class m210413_081857_alter_uuid_in_user
 */
class m210413_081857_alter_uuid_in_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'uuid');

        (Yii::$app->getDb())
            ->createCommand('
                ALTER TABLE "user" ADD uuid uuid NOT NULL UNIQUE;
            ')
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210413_081857_alter_uuid_in_user reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210413_081857_alter_uuid_in_user cannot be reverted.\n";

        return false;
    }
    */
}
