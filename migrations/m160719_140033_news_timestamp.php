<?php

use yii\db\Migration;

class m160719_140033_news_timestamp extends Migration
{
    public function up()
    {
        $this->alterColumn('news','publishing_since', $this->timestamp() . ' DEFAULT NOW()');
    }

    public function down()
    {
        $this->alterColumn('news','publishing_since', $this->timestamp()->defaultValue(null));
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
