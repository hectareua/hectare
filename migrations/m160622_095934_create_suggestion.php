<?php

use yii\db\Migration;

/**
 * Handles the creation for table `suggestion`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `product`
 */
class m160622_095934_create_suggestion extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('suggestion', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'suggestion_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-suggestion-product_id',
            'suggestion',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-suggestion-product_id',
            'suggestion',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `suggestion_id`
        $this->createIndex(
            'idx-suggestion-suggestion_id',
            'suggestion',
            'suggestion_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-suggestion-suggestion_id',
            'suggestion',
            'suggestion_id',
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
        $this->dropTable('suggestion');
    }
}
