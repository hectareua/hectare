<?php

use yii\db\Migration;

class m160811_065858_order_ttn extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'ttn', $this->string(32)->after('status_id'));
    }

    public function down()
    {
        $this->dropColumn('order', 'ttn');
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
