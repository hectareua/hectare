<?php

use yii\db\Migration;

/**
 * Handles the creation of table `info_tabs_content`.
 */
class m180719_174415_create_info_tabs_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('info_tabs_content', [
            'id' => $this->primaryKey(),
            'info_tabs_id' => $this->integer(),
            'number' => $this->integer(),
            'image_id' => $this->integer(),
            'header_uk' => $this->string(),
            'header_ru' => $this->string(),
            'desc_uk' => $this->text(),
            'desc_ru' => $this->text(),
            'author_uk' => $this->string(),
            'author_ru' => $this->string(),
            'views' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-info_tabs_content-image_id',
            'info_tabs_content',
            'image_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('info_tabs_content');
    }
}
