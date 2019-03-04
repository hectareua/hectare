<?php

use yii\db\Migration;

/**
 * Handles the creation of table `save_with_us`.
 */
class m180629_092957_create_save_with_us_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('save_with_us', [
            'id' => $this->primaryKey(),
            'name_uk' => $this->string(),
            'name_ru' => $this->string(),
            'image_id' => $this->integer(),
            'text_uk' => $this->text(),
            'text_ru' => $this->text(),
        ]);


        // creates index for column `order_id`
        $this->createIndex(
            'idx-save_with_us-image_id',
            'save_with_us',
            'image_id'
        );
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('save_with_us');
    }
}
