<?php

use yii\db\Migration;

/**
 * Handles adding img_id_desk_uk to table `slide`.
 */
class m180915_161002_add_img_id_desk_uk_column_to_slide_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('slide', 'img_id_desk_uk', $this->integer());
        $this->addColumn('slide', 'img_id_desk_ru', $this->integer());
        // creates index for column `image_id_uk`
        $this->createIndex(
            'idx-slide-img_id_desk_uk',
            'slide',
            'img_id_desk_uk'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-slide-img_id_desk_uk',
            'slide',
            'img_id_desk_uk',
            'image',
            'id',
            'CASCADE'
        );

        // creates index for column `image_id_ru`
        $this->createIndex(
            'idx-slide-img_id_desk_ru',
            'slide',
            'img_id_desk_ru'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-slide-img_id_desk_ru',
            'slide',
            'img_id_desk_ru',
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
        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-slide-img_id_desk_ru',
            'slide'
        );

        // drops index for column `image_id_ru`
        $this->dropIndex(
            'idx-slide-img_id_desk_ru',
            'slide'
        );

        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-slide-img_id_desk_uk',
            'slide'
        );

        // drops index for column `image_id_uk`
        $this->dropIndex(
            'idx-slide-img_id_desk_uk',
            'slide'
        );
        $this->dropColumn('slide', 'img_id_desk_uk');
        $this->dropColumn('slide', 'img_id_desk_ru');
    }
}
