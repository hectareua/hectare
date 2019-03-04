<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product_question`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `user`
 */
class m160630_063128_create_product_question extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_question', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'asked_at' => $this->datetime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_question-product_id',
            'product_question',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_question-product_id',
            'product_question',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-product_question-user_id',
            'product_question',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-product_question-user_id',
            'product_question',
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
        $this->dropTable('product_question');
    }
}
