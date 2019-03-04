<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `contact`.
 */
class m160720_090108_drop_contact extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('contact');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
         $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'contact' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ]);
    }
}
