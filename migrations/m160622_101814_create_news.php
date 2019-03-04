<?php

use yii\db\Migration;

/**
 * Handles the creation for table `news`.
 * Has foreign keys to the tables:
 *
 * - `image`
 */
class m160622_101814_create_news extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'publishing_since' => $this->timestamp(),
            'publishing_till' => $this->timestamp(),
            'title_uk' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'text_uk' => $this->text()->notNull(),
            'text_ru' => $this->text()->notNull(),
            'image_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `image_id`
        $this->createIndex(
            'idx-news-image_id',
            'news',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-news-image_id',
            'news',
            'image_id',
            'image',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
