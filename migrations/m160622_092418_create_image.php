<?php

use yii\db\Migration;

/**
 * Handles the creation for table `image`.
 */
class m160622_092418_create_image extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'remote' => $this->boolean()->defaultValue(1),
            'url' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('image');
    }
}
