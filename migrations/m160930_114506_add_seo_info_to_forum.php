<?php

use yii\db\Migration;

/**
 * Handles adding seo_info to table `forum`.
 */
class m160930_114506_add_seo_info_to_forum extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('forum', 'seo_title_uk', 'string DEFAULT NULL');
        $this->addColumn('forum', 'seo_title_ru', 'string DEFAULT NULL');
        $this->addColumn('forum', 'seo_keywords_uk', 'text DEFAULT NULL');
        $this->addColumn('forum', 'seo_keywords_ru', 'text DEFAULT NULL');
        $this->addColumn('forum', 'seo_description_uk', 'text DEFAULT NULL');
        $this->addColumn('forum', 'seo_description_ru', 'text DEFAULT NULL');
        $this->addColumn('forum', 'slug', 'string DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('forum', 'seo_title_uk');
        $this->dropColumn('forum', 'seo_title_ru');
        $this->dropColumn('forum', 'seo_keywords_uk');
        $this->dropColumn('forum', 'seo_keywords_ru');
        $this->dropColumn('forum', 'seo_description_uk');
        $this->dropColumn('forum', 'seo_description_ru');
        $this->dropColumn('forum', 'slug');
    }
}
