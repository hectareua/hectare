<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `image_info`.
 */
class m160927_072829_drop_image_info extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('image_info');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('image_info', [
            'id' => $this->primaryKey(),
            'width' => $this->integer()->notNull(),
            'height' => $this->integer()->notNull(),
            'hash' => $this->string(32)->notNull()->unique(),
        ]);
    }
}
