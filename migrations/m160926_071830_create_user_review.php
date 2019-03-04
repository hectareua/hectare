<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_review`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m160926_071830_create_user_review extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_review', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'rating_delivery' => $this->integer()->notNull(),
            'rating_service' => $this->integer()->notNull(),
            'rating_work' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_review-user_id',
            'user_review',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_review-user_id',
            'user_review',
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
            'fk-user_review-user_id',
            'user_review'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_review-user_id',
            'user_review'
        );

        $this->dropTable('user_review');
    }
}
