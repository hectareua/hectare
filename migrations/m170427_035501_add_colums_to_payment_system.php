<?php

use yii\db\Migration;

/**
 * Handles adding colums to table `payment_system_table`.
 */
class m170427_035501_add_colums_to_payment_system extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payment_system', 'logo', $this->string(50));
        $this->addColumn('payment_system', 'bank', $this->string(50));
        $this->addColumn('payment_system', 'down_payment', $this->string(50));
        $this->addColumn('payment_system', 'grace_period', $this->string(50));
        $this->addColumn('payment_system', 'description_ru', $this->string(100));
        $this->addColumn('payment_system', 'description_uk', $this->string(100));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payment_system', 'logo');
        $this->dropColumn('payment_system', 'bank');
        $this->dropColumn('payment_system', 'down_payment');
        $this->dropColumn('payment_system', 'grace_period');
        $this->dropColumn('payment_system', 'description_ru');
        $this->dropColumn('payment_system', 'description_uk');
    }
}
