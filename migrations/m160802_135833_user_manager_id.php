<?php

use yii\db\Migration;

class m160802_135833_user_manager_id extends Migration
{
    public function up()
    {
      $this->addColumn('user', 'manager_id', 'integer AFTER `is_active`');

      $this->createIndex(
          'idx-user-manager_id',
          'user',
          'manager_id'
      );

      $this->addForeignKey(
          'fk-user-manager_id',
          'user',
          'manager_id',
          'manager',
          'id',
          'CASCADE'
      );
    }

    public function down()
    {
        $this->dropForeignKey('fk-user-manager_id', 'user');
        $this->dropColumn('user', 'manager_id');
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
