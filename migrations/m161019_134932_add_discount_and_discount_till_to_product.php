<?php

use yii\db\Migration;

/**
 * Handles adding discount and discount_till to table `product`.
 */
class m161019_134932_add_discount_and_discount_till_to_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'discount', 'integer DEFAULT NULL');
        $this->addColumn('product', 'discount_till', 'date DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'discount');
        $this->dropColumn('product', 'discount_till');
    }
}
