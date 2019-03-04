<?php

use yii\db\Migration;

/**
 * Handles adding discount to table `order_product`.
 */
class m161019_135058_add_discount_to_order_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order_product', 'discount', 'integer DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order_product', 'discount');
    }
}
