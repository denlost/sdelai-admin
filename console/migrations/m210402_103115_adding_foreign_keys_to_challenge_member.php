<?php

use yii\db\Migration;

/**
 * Class m210402_103115_adding_foreign_keys_to_challenge_member
 */
class m210402_103115_adding_foreign_keys_to_challenge_member extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-challenge_member-user_id-user-id',
            'challenge_member',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-challenge_member-challenge_id-challenge-id',
            'challenge_member',
            'challenge_id',
            'challenge',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-challenge_member-user_id-user-id',
            'challenge_member'
        );

        $this->dropForeignKey(
            'fk-challenge_member-challenge_id-challenge-id',
            'challenge_member'
        );
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210402_103115_adding_foreig_keys_to_challenge_member cannot be reverted.\n";

        return false;
    }
    */
}
