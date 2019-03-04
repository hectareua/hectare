<?php

use yii\db\Migration;

/**
 * Handles the creation for table `article`.
 */
class m170713_200452_create_article extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'publishing_since' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'publishing_till' => $this->timestamp()->defaultValue('0000-00-00 00:00:00'),
            'title_uk' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'text_uk' => $this->text()->notNull(),
            'text_ru' => $this->text()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'seo_title_uk' => $this->string(),
            'seo_title_ru' => $this->string(),
            'seo_keywords_uk' => $this->text(),
            'seo_keywords_ru' => $this->text(),
            'seo_description_uk' => $this->text(),
            'seo_description_ru' => $this->text(),
            'slug' => $this->string(),
        ]);

        // creates index for column `image_id`
        $this->createIndex(
            'idx-article-image_id',
            'article',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-article-image_id',
            'article',
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
        $this->dropTable('article');
    }
}
