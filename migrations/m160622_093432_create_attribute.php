<?php

use yii\db\Migration;

/**
 * Handles the creation for table `attribute`.
 */
class m160622_093432_create_attribute extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('attribute', [
            'id' => $this->primaryKey(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('attribute');
    }
}
