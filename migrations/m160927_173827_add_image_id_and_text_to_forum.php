<?php

use yii\db\Migration;

/**
 * Handles adding image_id_and_text to table `forum`.
 */
class m160927_173827_add_image_id_and_text_to_forum extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('forum', 'image_id', 'integer');
        $this->addColumn('forum', 'text', 'text');


        // creates index for column `image_id`
        $this->createIndex(
            'idx-forum-image_id',
            'forum',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-forum-image_id',
            'forum',
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
        $this->dropForeignKey('fk-forum-image_id', 'forum');
        $this->dropColumn('forum', 'image_id');
        $this->dropColumn('forum', 'text');
    }
}
