<?php

use yii\db\Migration;

/**
 * Handles the creation of table `info_tabs`.
 */
class m180719_141313_create_info_tabs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('info_tabs', [
            'id' => $this->primaryKey(),
            'name_uk' => $this->string(),
            'name_ru' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('info_tabs');
    }
}
