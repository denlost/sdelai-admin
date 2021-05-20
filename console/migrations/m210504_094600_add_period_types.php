<?php

use yii\db\Migration;

/**
 * Class m210504_094600_add_period_types
 */
class m210504_094600_add_period_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $periodTypes = [
            'День' => 'day',
            'Неделя' => 'week',
            'Месяц' => 'month',
        ];

        foreach ($periodTypes as $name => $code) {
            $this->insert('period_type', [
                'name' => $name,
                'code' => $code
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210504_094600_add_period_types cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210504_094600_add_period_types cannot be reverted.\n";

        return false;
    }
    */
}
