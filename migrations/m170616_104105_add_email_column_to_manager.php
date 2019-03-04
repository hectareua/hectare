<?php

use yii\db\Migration;

/**
 * Handles adding email_column to table `manager`.
 */
class m170616_104105_add_email_column_to_manager extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('manager', 'email', $this->string(50));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('manager', 'email');
    }
}
