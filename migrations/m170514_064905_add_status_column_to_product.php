<?php

use yii\db\Migration;

/**
 * Handles adding status_column to table `product`.
 */
class m170514_064905_add_status_column_to_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'status', $this->integer(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'status');
    }
}
