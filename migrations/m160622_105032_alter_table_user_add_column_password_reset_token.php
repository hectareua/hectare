<?php

use yii\db\Migration;

class m160622_105032_alter_table_user_add_column_password_reset_token extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'password_reset_token', $this->string()->unique()->after('auth_key'));
    }

    public function down()
    {
        $this->dropColumn('user', 'password_reset_token');
    }
}
