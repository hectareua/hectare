<?php

use yii\db\Migration;

/**
 * Handles adding parent_id to table `review`.
 */
class m161017_140650_add_parent_id_to_review extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn("review", "parent_id", "integer DEFAULT NULL");

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-review-parent_id',
            'review',
            'parent_id'
        );

        // add foreign key for table `review`
        $this->addForeignKey(
            'fk-review-parent_id',
            'review',
            'parent_id',
            'review',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-review-parent_id', 'review');
        $this->dropColumn('review', 'parent_id');
    }
}
