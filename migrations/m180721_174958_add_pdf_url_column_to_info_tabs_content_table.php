<?php

use yii\db\Migration;

/**
 * Handles adding pdf_url to table `info_tabs_content`.
 */
class m180721_174958_add_pdf_url_column_to_info_tabs_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('info_tabs_content', 'pdf_url', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('info_tabs_content', 'pdf_url');
    }
}
