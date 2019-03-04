<?php

use yii\db\Migration;

/**
 * Handles adding seo_headers to table `category`.
 */
class m161223_085446_add_seo_headers_to_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category', 'seo_header_uk', $this->string());
        $this->addColumn('category', 'seo_header_ru', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category', 'seo_header_uk');
        $this->dropColumn('category', 'seo_header_ru');
    }
}
