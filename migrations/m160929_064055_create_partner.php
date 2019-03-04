<?php

use yii\db\Migration;

/**
 * Handles the creation for table `partner`.
 * Has foreign keys to the tables:
 *
 * - `image`
 */
class m160929_064055_create_partner extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('partner', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `image_id`
        $this->createIndex(
            'idx-partner-image_id',
            'partner',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-partner-image_id',
            'partner',
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
            'fk-partner-image_id',
            'partner'
        );

        // drops index for column `image_id`
        $this->dropIndex(
            'idx-partner-image_id',
            'partner'
        );

        $this->dropTable('partner');
    }
}
