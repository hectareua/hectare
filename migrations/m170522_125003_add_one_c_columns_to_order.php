<?php

use yii\db\Migration;

/**
 * Handles adding one_c_columns to table `order`.
 */
class m170522_125003_add_one_c_columns_to_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'one_c_order_id', $this->string(100));
        $this->addColumn('order', 'products_one_c', $this->string(255));
        $this->addColumn('order', 'is_one_c_order', $this->boolean()->defaultValue(0));

        // creates index for column `author_id`
        $this->createIndex(
            'idx-order-one_c_order_id',
            'order',
            'one_c_order_id'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'one_c_order_id');
        $this->dropColumn('order', 'products_one_c');
        $this->dropColumn('order', 'is_one_c_order');
        
        // drops index for column `author_id`
        $this->dropIndex(
            'idx-order-one_c_order_id',
            'order'
        );
    }
}
