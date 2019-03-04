<?php

use yii\db\Migration;

/**
 * Handles the creation for table `filter_table`.
 * Has foreign keys to the tables:
 *
 * - `filter`
 */
class m161207_152608_create_filter_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

      
        $this->createTable('filter', [
            'id' => $this->primaryKey(),
            'filter_id' => $this->integer()->notNull(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);

        // creates index for column `filter_id`
        $this->createIndex(
            'idx-filter-filter_id',
            'filter',
            'filter_id'
        );

        // add foreign key for table `filter`
        $this->addForeignKey(
            'fk-filter-filter_id',
            'filter',
            'filter_id',
            'filter',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `filter`
        $this->dropForeignKey(
            'fk-filter-filter_id',
            'filter'
        );

        // drops index for column `filter_id`
        $this->dropIndex(
            'idx-filter-filter_id',
            'filter'
        );

        $this->dropTable('filter');
    }
}
