<?php

use yii\db\Migration;

/**
 * Handles the creation for table `forum`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `user`
 */
class m160702_105659_create_forum extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('forum', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-forum-category_id',
            'forum',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-forum-category_id',
            'forum',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-forum-user_id',
            'forum',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-forum-user_id',
            'forum',
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
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-forum-category_id',
            'forum'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-forum-category_id',
            'forum'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-forum-user_id',
            'forum'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-forum-user_id',
            'forum'
        );

        $this->dropTable('forum');
    }
}
