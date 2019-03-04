<?php

use yii\db\Migration;

/**
 * Handles the creation for table `review_like`.
 */
class m170603_153951_create_like extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('like', [
            'id' => $this->primaryKey(),
            'type' => $this->boolean(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-filter_to_like-user_id',
            'like',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-filter_to_like-user_id',
            'like'
        );
        $this->dropTable('like');
    }
}
