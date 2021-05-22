<?php

use yii\db\Migration;

/**
 * Class m210522_104019_alter_verify_tables
 */
class m210522_104019_alter_verify_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('sms_verify', 'count', $this->integer(1)->notNull()->defaultValue(0));
       $this->addCommentOnColumn('sms_verify', 'count', 'Count of code enters');
       $this->addColumn('verify_lock', 'count', $this->integer(1)->notNull()->defaultValue(0));
       $this->addCommentOnColumn('verify_lock', 'count', 'Count of new code requests');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('sms_verify', 'count');
        $this->dropCommentFromColumn('sms_verify', 'count');
        $this->dropColumn('verify_lock', 'count');
        $this->dropCommentFromColumn('verify_lock', 'count');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210522_104019_alter_verify_tables cannot be reverted.\n";

        return false;
    }
    */
}
