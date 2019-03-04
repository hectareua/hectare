<?php

use yii\db\Migration;

class m160713_080854_order_timestamp extends Migration
{
    public function up()
    {
        $this->alterColumn('order','ordered_at', $this->timestamp() . ' DEFAULT NOW()');
    }

    public function down()
    {
        $this->alterColumn('order','ordered_at', $this->timestamp()->defaultValue(null));
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
