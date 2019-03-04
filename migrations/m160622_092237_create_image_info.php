<?php

use yii\db\Migration;

/**
 * Handles the creation for table `image_info`.
 */
class m160622_092237_create_image_info extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image_info', [
            'id' => $this->primaryKey(),
            'width' => $this->integer()->notNull(),
            'height' => $this->integer()->notNull(),
            'hash' => $this->string(32)->notNull()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('image_info');
    }
}
