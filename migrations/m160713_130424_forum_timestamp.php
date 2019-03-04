<?php

use yii\db\Migration;

class m160713_130424_forum_timestamp extends Migration
{
    public function up()
    {
        $this->alterColumn('forum','created_at', $this->timestamp() . ' DEFAULT NOW()');
    }

    public function down()
    {
        $this->alterColumn('forum','created_at', $this->timestamp()->defaultValue(null));
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
