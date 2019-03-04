<?php

use yii\db\Migration;

/**
 * Handles adding image_two_id to table `manager`.
 */
class m170625_074329_add_image_two_id_to_manager extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('manager', 'image_two_id', $this->integer());

        $this->addForeignKey(
            'fk-manager-image_two_id',
            'manager',
            'image_two_id',
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
        $this->dropForeignKey(
            'fk-manager-image_two_id',
            'manager'
        );

        $this->dropColumn('manager', 'image_two_id');
    }
}
