<?php

use yii\db\Migration;

class m160714_134145_contact_table extends Migration
{
    public function up()
    {
         $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'contact' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('contact');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
