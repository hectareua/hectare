<?php

use yii\db\Migration;

class m160802_134508_manager extends Migration
{
    public function up()
    {
      $this->createTable('manager', [
         'id' => $this->primaryKey(),
         'name' => $this->string()->notNull(),
         'phone' => $this->string()->notNull(),
         'image_id' => $this->integer()->notNull(),
       ]);

       // creates index for column `image_id`
       $this->createIndex(
           'idx-manager-image_id',
           'manager',
           'image_id'
       );

       // add foreign key for table `image`
       $this->addForeignKey(
           'fk-manager-image_id',
           'manager',
           'image_id',
           'image',
           'id',
           'CASCADE'
       );


    }

    public function down()
    {
      $this->dropTable('manager');
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
