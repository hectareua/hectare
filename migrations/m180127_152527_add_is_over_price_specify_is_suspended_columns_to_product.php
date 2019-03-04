<?php

use yii\db\Migration;

class m180127_152527_add_is_over_price_specify_is_suspended_columns_to_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'is_over', $this->smallInteger(2)->defaultValue(0)->after('is_new'));
        $this->addColumn('product', 'price_specify', $this->smallInteger(2)->defaultValue(0)->after('is_over'));
        $this->addColumn('product', 'is_suspended', $this->smallInteger(2)->defaultValue(0)->after('price_specify'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'is_over');
        $this->dropColumn('product', 'price_specify');
        $this->dropColumn('product', 'is_suspended');
    }
}
