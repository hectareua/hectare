<?php

use yii\db\Migration;

/**
 * Handles adding seoinfo to table `manufacturer`.
 */
class m161222_174250_add_seoinfo_to_manufacturer extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('manufacturer', 'seo_title_uk', $this->string());
        $this->addColumn('manufacturer', 'seo_title_ru', $this->string());
        $this->addColumn('manufacturer', 'seo_description_uk', $this->text());
        $this->addColumn('manufacturer', 'seo_description_ru', $this->text());
        $this->addColumn('manufacturer', 'seo_keywords_uk', $this->text());
        $this->addColumn('manufacturer', 'seo_keywords_ru', $this->text());
        $this->addColumn('manufacturer', 'seo_header_uk', $this->string());
        $this->addColumn('manufacturer', 'seo_header_ru', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('manufacturer', 'seo_title_uk');
        $this->dropColumn('manufacturer', 'seo_title_ru');
        $this->dropColumn('manufacturer', 'seo_description_uk');
        $this->dropColumn('manufacturer', 'seo_description_ru');
        $this->dropColumn('manufacturer', 'seo_keywords_uk');
        $this->dropColumn('manufacturer', 'seo_keywords_ru');
        $this->dropColumn('manufacturer', 'seo_header_uk');
        $this->dropColumn('manufacturer', 'seo_header_ru');
    }
}
