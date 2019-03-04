<?php

use yii\db\Migration;

/**
 * Handles the creation for table `review_like`.
 */
class m170603_155639_create_review_like extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('review_like', [
                'review_id' => $this->integer()->notNull(),
                'like_id' => $this->integer()->notNull(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('review_like');
    }
}
