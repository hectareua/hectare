<?php

use yii\db\Migration;

/**
 * Handles adding seoinfo to table `filter`.
 */
class m161222_174707_add_seoinfo_to_filter extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('filter', 'seo_title_uk', $this->string());
        $this->addColumn('filter', 'seo_title_ru', $this->string());
        $this->addColumn('filter', 'seo_description_uk', $this->text());
        $this->addColumn('filter', 'seo_description_ru', $this->text());
        $this->addColumn('filter', 'seo_keywords_uk', $this->text());
        $this->addColumn('filter', 'seo_keywords_ru', $this->text());
        $this->addColumn('filter', 'seo_header_uk', $this->string());
        $this->addColumn('filter', 'seo_header_ru', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('filter', 'seo_title_uk');
        $this->dropColumn('filter', 'seo_title_ru');
        $this->dropColumn('filter', 'seo_description_uk');
        $this->dropColumn('filter', 'seo_description_ru');
        $this->dropColumn('filter', 'seo_keywords_uk');
        $this->dropColumn('filter', 'seo_keywords_ru');
        $this->dropColumn('filter', 'seo_header_uk');
        $this->dropColumn('filter', 'seo_header_ru');
    }
}
