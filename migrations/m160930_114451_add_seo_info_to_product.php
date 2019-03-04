<?php

use yii\db\Migration;

/**
 * Handles adding seo_info to table `product`.
 */
class m160930_114451_add_seo_info_to_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('product', 'seo_title_uk', 'string DEFAULT NULL');
        $this->addColumn('product', 'seo_title_ru', 'string DEFAULT NULL');
        $this->addColumn('product', 'seo_keywords_uk', 'text DEFAULT NULL');
        $this->addColumn('product', 'seo_keywords_ru', 'text DEFAULT NULL');
        $this->addColumn('product', 'seo_description_uk', 'text DEFAULT NULL');
        $this->addColumn('product', 'seo_description_ru', 'text DEFAULT NULL');
        $this->addColumn('product', 'slug', 'string DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('product', 'seo_title_uk');
        $this->dropColumn('product', 'seo_title_ru');
        $this->dropColumn('product', 'seo_keywords_uk');
        $this->dropColumn('product', 'seo_keywords_ru');
        $this->dropColumn('product', 'seo_description_uk');
        $this->dropColumn('product', 'seo_description_ru');
        $this->dropColumn('product', 'slug');
    }
}
