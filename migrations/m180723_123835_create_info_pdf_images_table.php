<?php

use yii\db\Migration;

/**
 * Handles the creation of table `info_pfd_images`.
 */
class m180723_123835_create_info_pfd_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('info_pfd_images', [
            'id' => $this->primaryKey(),
            'info_tabs_content_id' => $this->integer(),
            'image_id' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('info_pfd_images');
    }
}
