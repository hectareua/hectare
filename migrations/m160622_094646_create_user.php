<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160622_094646_create_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string(32)->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'is_admin' => $this->boolean()->defaultValue(0),
            'is_active' => $this->boolean()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
