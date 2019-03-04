<?php

use yii\db\Migration;

/**
 * Handles the creation for table `currency`.
 */
class m160622_093056_create_currency extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->string(3)->notNull(),
            'rate' => $this->float(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('currency');
    }
}
