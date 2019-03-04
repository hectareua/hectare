<?php

use yii\db\Migration;

/**
 * Handles the creation for table `call_request`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m160926_080531_create_call_request extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('call_request', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'requested_at' => $this->datetime()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-call_request-user_id',
            'call_request',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-call_request-user_id',
            'call_request',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-call_request-user_id',
            'call_request'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-call_request-user_id',
            'call_request'
        );

        $this->dropTable('call_request');
    }
}
