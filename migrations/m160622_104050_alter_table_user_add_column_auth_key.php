<?php

use yii\db\Migration;

class m160622_104050_alter_table_user_add_column_auth_key extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'auth_key', $this->string(32)->notNull()->after('password_hash'));
    }

    public function down()
    {
        $this->dropColumn('user', 'auth_key');
    }
}
