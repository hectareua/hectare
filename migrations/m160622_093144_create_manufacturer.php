<?php

use yii\db\Migration;

/**
 * Handles the creation for table `manufacturer`.
 */
class m160622_093144_create_manufacturer extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('manufacturer', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('manufacturer');
    }
}
