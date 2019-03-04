<?php

use yii\db\Migration;

/**
 * Handles the creation for table `measure_table`.
 */
class m170611_034719_create_measure_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('measure', [
            'id' => $this->primaryKey(),
            'name_uk' => $this->string()->notNull(),
            'unit' => $this->string()->notNull(),
            'opt' => $this->boolean(),
            'attribute_id' => $this->integer(),
        ]);

        // creates index for column `attribute_id`
        $this->addForeignKey(
            'fk-filter_to_measure-attribute_id',
            'measure',
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
        $this->dropForeignKey(
            'fk-filter_to_measure-attribute_id',
            'measure'
        );
        $this->dropTable('measure');
    }
}
