<?php

use yii\db\Migration;

/**
 * Class m210520_134851_create_verification_tables
 */
class m210520_134851_create_verification_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sms_verify', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'code' => $this->string(6)->notNull(),
            'date_expire' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk-sms_verify-user_id-user-id',
            'sms_verify',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'ik-sms_verify-user_id-code',
            'sms_verify',
            ['user_id', 'code'],
            true
        );

        $this->createTable('verify_lock', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date_expire' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk-verify_lock-user_id-user-id',
            'verify_lock',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210520_134851_create_verification_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210520_134851_create_verification_tables cannot be reverted.\n";

        return false;
    }
    */
}
