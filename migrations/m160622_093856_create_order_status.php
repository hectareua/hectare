<?php

use yii\db\Migration;

/**
 * Handles the creation for table `order_status`.
 */
class m160622_093856_create_order_status extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_status', [
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
        $this->dropTable('order_status');
    }
}
