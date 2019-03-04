<?php

use yii\db\Migration;

/**
 * Handles adding one_c_price_column to table `order`.
 */
class m170529_113331_add_one_c_price_column_to_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'one_c_price', $this->integer()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'one_c_price');
    }
}
