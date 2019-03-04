<?php

use yii\db\Migration;

class m161208_143226_alter_filter_id_filter_table extends Migration
{
    public function up()
    {
        $this->alterColumn('filter', 'filter_id', $this->integer());
    }

    public function down()
    {
        $this->alterColumn('filter', 'filter_id', $this->integer()->notNull());
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
