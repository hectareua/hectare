<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_image`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `image`
 */
class m160623_095117_create_product_image extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_image', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_image-product_id',
            'product_image',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_image-product_id',
            'product_image',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `image_id`
        $this->createIndex(
            'idx-product_image-image_id',
            'product_image',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-product_image-image_id',
            'product_image',
            'image_id',
            'image',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_image');
    }
}
