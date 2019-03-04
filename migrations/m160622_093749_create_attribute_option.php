<?php

use yii\db\Migration;

/**
 * Handles the creation for table `attribute_option`.
 * Has foreign keys to the tables:
 *
 * - `attribute`
 */
class m160622_093749_create_attribute_option extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('attribute_option', [
            'id' => $this->primaryKey(),
            'attribute_id' => $this->integer()->notNull(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);

        // creates index for column `attribute_id`
        $this->createIndex(
            'idx-attribute_option-attribute_id',
            'attribute_option',
            'attribute_id'
        );

        // add foreign key for table `attribute`
        $this->addForeignKey(
            'fk-attribute_option-attribute_id',
            'attribute_option',
            'attribute_id',
            'attribute',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('attribute_option');
    }
}
