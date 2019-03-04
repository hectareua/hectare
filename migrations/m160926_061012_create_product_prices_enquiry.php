<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_prices_enquiry`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `user`
 */
class m160926_061012_create_product_prices_enquiry extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_prices_enquiry', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'asked_at' => $this->datetime(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_prices_enquiry-product_id',
            'product_prices_enquiry',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_prices_enquiry-product_id',
            'product_prices_enquiry',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-product_prices_enquiry-user_id',
            'product_prices_enquiry',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-product_prices_enquiry-user_id',
            'product_prices_enquiry',
            'user_id',
            'user',
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
            'fk-product_prices_enquiry-product_id',
            'product_prices_enquiry'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_prices_enquiry-product_id',
            'product_prices_enquiry'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-product_prices_enquiry-user_id',
            'product_prices_enquiry'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-product_prices_enquiry-user_id',
            'product_prices_enquiry'
        );

        $this->dropTable('product_prices_enquiry');
    }
}
