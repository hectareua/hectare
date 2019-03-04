<?php

use yii\db\Migration;

/**
 * Handles the creation for table `representative`.
 */
class m160929_072050_create_representative extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('representative', [
            'id' => $this->primaryKey(),
            'region' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'phones' => $this->text(),
            'email' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('representative');
    }
}
