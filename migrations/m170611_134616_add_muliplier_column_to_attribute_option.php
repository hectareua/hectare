<?php

use yii\db\Migration;

/**
 * Handles adding muliplier_column to table `attribute_option`.
 */
class m170611_134616_add_muliplier_column_to_attribute_option extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('attribute_option', 'multiplier', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('attribute_option', 'multiplier');
    }
}
