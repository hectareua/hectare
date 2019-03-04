<?php

use yii\db\Migration;

/**
 * Handles adding method_column to table `payment_system`.
 */
class m170424_045614_add_method_column_to_payment_system extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payment_system', 'method', $this->string(10));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payment_system', 'method');
    }
}
