<?php

use yii\db\Migration;

/**
 * Handles adding opt_columns to table `attribute_value`.
 */
class m170615_042157_add_opt_columns_to_attribute_value extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('attribute_value', 'opt', $this->integer());
        $this->addColumn('attribute_value', 'opt1', $this->integer());
        $this->addColumn('attribute_value', 'opt_uk',$this->integer());
        $this->addColumn('attribute_value', 'opt_uk1', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('attribute_value', 'opt');
        $this->dropColumn('attribute_value', 'opt1');
        $this->dropColumn('attribute_value', 'opt_uk');
        $this->dropColumn('attribute_value', 'opt_uk1');
    }
}
