<?php

use yii\db\Migration;

/**
 * Handles the creation for table `payment_system`.
 */
class m160622_092847_create_payment_system extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('payment_system', [
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
        $this->dropTable('payment_system');
    }
}
