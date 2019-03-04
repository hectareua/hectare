<?php

use yii\db\Migration;

/**
 * Handles the creation for table `forum_message`.
 * Has foreign keys to the tables:
 *
 * - `forum`
 * - `user`
 */
class m160702_110000_create_forum_message extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('forum_message', [
            'id' => $this->primaryKey(),
            'forum_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        // creates index for column `forum_id`
        $this->createIndex(
            'idx-forum_message-forum_id',
            'forum_message',
            'forum_id'
        );

        // add foreign key for table `forum`
        $this->addForeignKey(
            'fk-forum_message-forum_id',
            'forum_message',
            'forum_id',
            'forum',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-forum_message-user_id',
            'forum_message',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-forum_message-user_id',
            'forum_message',
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
        // drops foreign key for table `forum`
        $this->dropForeignKey(
            'fk-forum_message-forum_id',
            'forum_message'
        );

        // drops index for column `forum_id`
        $this->dropIndex(
            'idx-forum_message-forum_id',
            'forum_message'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-forum_message-user_id',
            'forum_message'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-forum_message-user_id',
            'forum_message'
        );

        $this->dropTable('forum_message');
    }
}
