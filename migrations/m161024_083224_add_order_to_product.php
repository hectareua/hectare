<?php

use yii\db\Migration;

/**
 * Handles adding order to table `product`.
 */
class m161024_083224_add_order_to_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'order', 'integer NOT NULL');
        $this->execute("
            UPDATE `product`
            SET `order` = `id`
        ");
        $this->createIndex('order', 'product', 'order');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'order');
    }
}
