<?php

use yii\db\Migration;

/**
 * Handles the creation for table `field_option`.
 * Has foreign keys to the tables:
 *
 * - `field`
 */
class m160623_075120_create_field_option extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('field_option', [
            'id' => $this->primaryKey(),
            'field_id' => $this->integer()->notNull(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);

        // creates index for column `field_id`
        $this->createIndex(
            'idx-field_option-field_id',
            'field_option',
            'field_id'
        );

        // add foreign key for table `field`
        $this->addForeignKey(
            'fk-field_option-field_id',
            'field_option',
            'field_id',
            'field',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('field_option');
    }
}
