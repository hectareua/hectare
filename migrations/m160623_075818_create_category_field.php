<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_field`.
 * Has foreign keys to the tables:
 *
 * - `field`
 * - `category`
 */
class m160623_075818_create_category_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_field', [
            'id' => $this->primaryKey(),
            'field_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `field_id`
        $this->createIndex(
            'idx-category_field-field_id',
            'category_field',
            'field_id'
        );

        // add foreign key for table `field`
        $this->addForeignKey(
            'fk-category_field-field_id',
            'category_field',
            'field_id',
            'field',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_field-category_id',
            'category_field',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_field-category_id',
            'category_field',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_field');
    }
}
