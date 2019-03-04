<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `manufacturer`
 * - `currency`
 */
class m160622_095805_create_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'manufacturer_id' => $this->integer(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
            'description_uk' => $this->text()->notNull(),
            'description_ru' => $this->text()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'price' => $this->money()->notNull(),
            'old_price' => $this->money(),
            'is_in_stock' => $this->boolean(),
            'is_new' => $this->boolean(),
            'is_on_sale' => $this->boolean(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `manufacturer_id`
        $this->createIndex(
            'idx-product-manufacturer_id',
            'product',
            'manufacturer_id'
        );

        // add foreign key for table `manufacturer`
        $this->addForeignKey(
            'fk-product-manufacturer_id',
            'product',
            'manufacturer_id',
            'manufacturer',
            'id',
            'CASCADE'
        );

        // creates index for column `currency_id`
        $this->createIndex(
            'idx-product-currency_id',
            'product',
            'currency_id'
        );

        // add foreign key for table `currency`
        $this->addForeignKey(
            'fk-product-currency_id',
            'product',
            'currency_id',
            'currency',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
