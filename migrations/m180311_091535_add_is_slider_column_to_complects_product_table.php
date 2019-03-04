<?php

use yii\db\Migration;

/**
 * Handles adding is_slider to table `complects_product`.
 */
class m180311_091535_add_is_slider_column_to_complects_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('complects_product', 'is_slider', $this->smallInteger(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('complects_product', 'is_slider');
    }
}
