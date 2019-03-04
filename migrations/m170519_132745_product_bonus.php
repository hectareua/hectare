<?php

use yii\db\Migration;

class m170519_132745_product_bonus extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'bonus', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('product', 'bonus');
    }
}
