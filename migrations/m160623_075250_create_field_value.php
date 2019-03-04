<?php

use yii\db\Migration;

/**
 * Handles the creation for table `field_value`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `field_option`
 */
class m160623_075250_create_field_value extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('field_value', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'option_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-field_value-product_id',
            'field_value',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-field_value-product_id',
            'field_value',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `option_id`
        $this->createIndex(
            'idx-field_value-option_id',
            'field_value',
            'option_id'
        );

        // add foreign key for table `field_option`
        $this->addForeignKey(
            'fk-field_value-option_id',
            'field_value',
            'option_id',
            'field_option',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('field_value');
    }
}
