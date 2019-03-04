<?php

use yii\db\Migration;

/**
 * Handles the creation for table `order_product`.
 * Has foreign keys to the tables:
 *
 * - `order`
 * - `product`
 */
class m160622_101248_create_order_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_product', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'amount' => $this->integer(),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            'idx-order_product-order_id',
            'order_product',
            'order_id'
        );

        // add foreign key for table `order`
        $this->addForeignKey(
            'fk-order_product-order_id',
            'order_product',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-order_product-product_id',
            'order_product',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-order_product-product_id',
            'order_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_product');
    }
}
