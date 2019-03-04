<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `image`
 */
class m160622_092736_create_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
            'description_uk' => $this->text()->notNull(),
            'description_ru' => $this->text()->notNull(),
            'image_id' => $this->integer(),
            'order' => $this->smallInteger()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-category-parent_id',
            'category',
            'parent_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category-parent_id',
            'category',
            'parent_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `image_id`
        $this->createIndex(
            'idx-category-image_id',
            'category',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-category-image_id',
            'category',
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
        $this->dropTable('category');
    }
}
