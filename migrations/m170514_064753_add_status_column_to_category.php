<?php

use yii\db\Migration;

/**
 * Handles adding status_column to table `category`.
 */
class m170514_064753_add_status_column_to_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category', 'status', $this->integer(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category', 'status');
    }
}
