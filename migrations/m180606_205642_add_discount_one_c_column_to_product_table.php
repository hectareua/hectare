<?php

use yii\db\Migration;

/**
 * Handles adding discount_one_c to table `product`.
 */
class m180606_205642_add_discount_one_c_column_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'discount_one_c', $this->integer()->defaultValue(null)->after('discount'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'discount_one_c');
    }
}
