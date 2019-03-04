<?php

use yii\db\Migration;

/**
 * Handles adding seo_info to table `news`.
 */
class m160930_114503_add_seo_info_to_news extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'seo_title_uk', 'string DEFAULT NULL');
        $this->addColumn('news', 'seo_title_ru', 'string DEFAULT NULL');
        $this->addColumn('news', 'seo_keywords_uk', 'text DEFAULT NULL');
        $this->addColumn('news', 'seo_keywords_ru', 'text DEFAULT NULL');
        $this->addColumn('news', 'seo_description_uk', 'text DEFAULT NULL');
        $this->addColumn('news', 'seo_description_ru', 'text DEFAULT NULL');
        $this->addColumn('news', 'slug', 'string DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'seo_title_uk');
        $this->dropColumn('news', 'seo_title_ru');
        $this->dropColumn('news', 'seo_keywords_uk');
        $this->dropColumn('news', 'seo_keywords_ru');
        $this->dropColumn('news', 'seo_description_uk');
        $this->dropColumn('news', 'seo_description_ru');
        $this->dropColumn('news', 'slug');
    }
}
