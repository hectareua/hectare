<?php

use yii\db\Migration;

/**
 * Handles the creation for table `slide`.
 * Has foreign keys to the tables:
 *
 * - `image`
 */
class m160922_064830_create_slide extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('slide', [
            'id' => $this->primaryKey(),
            'description' => $this->text(),
            'image_id' => $this->integer()->notNull(),
        ]);

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

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-slide-image_id',
            'slide'
        );

        // drops index for column `image_id`
        $this->dropIndex(
            'idx-slide-image_id',
            'slide'
        );

        $this->dropTable('slide');
    }
}
