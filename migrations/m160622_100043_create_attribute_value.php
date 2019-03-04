<?php

use yii\db\Migration;

/**
 * Handles the creation for table `attribute_value`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `attribute_option`
 */
class m160622_100043_create_attribute_value extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('attribute_value', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'option_id' => $this->integer()->notNull(),
            'price' => $this->money(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-attribute_value-product_id',
            'attribute_value',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-attribute_value-product_id',
            'attribute_value',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `option_id`
        $this->createIndex(
            'idx-attribute_value-option_id',
            'attribute_value',
            'option_id'
        );

        // add foreign key for table `attribute_option`
        $this->addForeignKey(
            'fk-attribute_value-option_id',
            'attribute_value',
            'option_id',
            'attribute_option',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('attribute_value');
    }
}
