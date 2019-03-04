<?php

use yii\db\Migration;

/**
 * Handles adding type_column to table `order_table`.
 */
class m170418_043700_add_type_column_to_payment_system_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payment_system', 'type', $this->integer()->defaultValue(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payment_system', 'type');
    }
}
