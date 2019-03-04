<?php

use yii\db\Migration;

/**
 * Handles the creation for table `review_like`.
 */
class m170622_094434_create_anonymus_push extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('anonymus_push', [
            'push_token' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('anonymus_push');
    }
}
