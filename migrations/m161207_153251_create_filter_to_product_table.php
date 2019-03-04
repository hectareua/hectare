<?php

use yii\db\Migration;

/**
 * Handles the creation for table `filter_to_product_table`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `filter`
 */
class m161207_153251_create_filter_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('filter_to_product', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'filter_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-filter_to_product-product_id',
            'filter_to_product',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-filter_to_product-product_id',
            'filter_to_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `filter_id`
        $this->createIndex(
            'idx-filter_to_product-filter_id',
            'filter_to_product',
            'filter_id'
        );

        // add foreign key for table `filter`
        $this->addForeignKey(
            'fk-filter_to_product-filter_id',
            'filter_to_product',
            'filter_id',
            'filter',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-filter_to_product-product_id',
            'filter_to_product'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-filter_to_product-product_id',
            'filter_to_product'
        );

        // drops foreign key for table `filter`
        $this->dropForeignKey(
            'fk-filter_to_product-filter_id',
            'filter_to_product'
        );

        // drops index for column `filter_id`
        $this->dropIndex(
            'idx-filter_to_product-filter_id',
            'filter_to_product'
        );

        $this->dropTable('filter_to_product');
    }
}
