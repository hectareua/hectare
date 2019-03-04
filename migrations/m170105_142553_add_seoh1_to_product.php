<?php

use yii\db\Migration;

/**
 * Handles adding seoh1 to table `product`.
 */
class m170105_142553_add_seoh1_to_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'seo_header_uk', $this->string());
        $this->addColumn('product', 'seo_header_ru', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'seo_header_uk');
        $this->dropColumn('product', 'seo_header_ru');
    }
}
