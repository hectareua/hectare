<?php

use yii\db\Migration;

/**
 * Handles adding colums_and_modify_existed to table `slide`.
 */
class m170513_053556_add_columns_and_modify_existed_to_slide_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        
        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-slide-image_id',
            'slide'
        );

        $this->addColumn('slide', 'image_id_ru', $this->integer());
        $this->addColumn('slide', 'link_ru', $this->string());
        $this->renameColumn('slide', 'image_id', 'image_id_uk');
        $this->renameColumn('slide', 'link', 'link_uk');
        
        // creates index for column `image_id_uk`
        $this->createIndex(
            'idx-slide-image_id_uk',
            'slide',
            'image_id_uk'
        ); 

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-slide-image_id_uk',
            'slide',
            'image_id_uk',
            'image',
            'id',
            'CASCADE'
        );

        // creates index for column `image_id_ru`
        $this->createIndex(
            'idx-slide-image_id_ru',
            'slide',
            'image_id_ru'
        ); 
   
        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-slide-image_id_ru',
            'slide',
            'image_id_ru',
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
            'fk-slide-image_id_ru',
            'slide'
        );

        // drops index for column `image_id_ru`
        $this->dropIndex(
            'idx-slide-image_id_ru',
            'slide'
        );

        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-slide-image_id_uk',
            'slide'
        );

        // drops index for column `image_id_uk`
        $this->dropIndex(
            'idx-slide-image_id_uk',
            'slide'
        );

        $this->dropColumn('slide', 'image_id_ru');
        $this->dropColumn('slide', 'link_ru');

        $this->renameColumn('slide', 'image_id_uk', 'image_id');
        $this->renameColumn('slide', 'link_uk', 'link');
        
        // creates index for column `image_id`
        $this->createIndex(
            'idx-slide-image_id',
            'slide',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-slide-image_id',
            'slide',
            'image_id',
            'image',
            'id',
            'CASCADE'
        );

    }
}
