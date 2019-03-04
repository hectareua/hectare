<?php

use yii\db\Migration;

class m170518_121700_bonus_fields_migration extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'bonus_write_off_request', $this->integer());
        $this->addColumn('order', 'bonus_write_off', $this->integer());
        $this->addColumn('order', 'bonus_got', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('order', 'bonus_write_off_request');
        $this->dropColumn('order', 'bonus_write_off');
        $this->dropColumn('order', 'bonus_got');
    }
}
