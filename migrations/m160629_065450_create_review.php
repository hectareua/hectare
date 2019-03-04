<?php

use yii\db\Migration;

/**
 * Handles the creation for table `review`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `user`
 */
class m160629_065450_create_review extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('review', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
            'is_visible' => $this->boolean(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'posted_at' => $this->datetime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-review-product_id',
            'review',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-review-product_id',
            'review',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-review-user_id',
            'review',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-review-user_id',
            'review',
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
        $this->dropTable('review');
    }
}
