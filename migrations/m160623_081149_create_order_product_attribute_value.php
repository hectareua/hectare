<?php

use yii\db\Migration;

/**
 * Handles the creation for table `order_product_attribute_value`.
 * Has foreign keys to the tables:
 *
 * - `order_product`
 * - `attribute_value`
 */
class m160623_081149_create_order_product_attribute_value extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_product_attribute_value', [
            'id' => $this->primaryKey(),
            'order_product_id' => $this->integer()->notNull(),
            'attribute_value_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `order_product_id`
        $this->createIndex(
            'idx-order_product_attribute_value-order_product_id',
            'order_product_attribute_value',
            'order_product_id'
        );

        // add foreign key for table `order_product`
        $this->addForeignKey(
            'fk-order_product_attribute_value-order_product_id',
            'order_product_attribute_value',
            'order_product_id',
            'order_product',
            'id',
            'CASCADE'
        );

        // creates index for column `attribute_value_id`
        $this->createIndex(
            'idx-order_product_attribute_value-attribute_value_id',
            'order_product_attribute_value',
            'attribute_value_id'
        );

        // add foreign key for table `attribute_value`
        $this->addForeignKey(
            'fk-order_product_attribute_value-attribute_value_id',
            'order_product_attribute_value',
            'attribute_value_id',
            'attribute_value',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_product_attribute_value');
    }
}
