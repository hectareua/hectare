<?php

use yii\db\Migration;

/**
 * Handles adding seo_info to table `category`.
 */
class m160930_114457_add_seo_info_to_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category', 'seo_title_uk', 'string DEFAULT NULL');
        $this->addColumn('category', 'seo_title_ru', 'string DEFAULT NULL');
        $this->addColumn('category', 'seo_keywords_uk', 'text DEFAULT NULL');
        $this->addColumn('category', 'seo_keywords_ru', 'text DEFAULT NULL');
        $this->addColumn('category', 'seo_description_uk', 'text DEFAULT NULL');
        $this->addColumn('category', 'seo_description_ru', 'text DEFAULT NULL');
        $this->addColumn('category', 'slug', 'string DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category', 'seo_title_uk');
        $this->dropColumn('category', 'seo_title_ru');
        $this->dropColumn('category', 'seo_keywords_uk');
        $this->dropColumn('category', 'seo_keywords_ru');
        $this->dropColumn('category', 'seo_description_uk');
        $this->dropColumn('category', 'seo_description_ru');
        $this->dropColumn('category', 'slug');
    }
}
