<?php

use yii\db\Migration;

/**
 * Handles adding link to table `slide`.
 */
class m161020_111747_add_link_to_slide extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('slide', 'link', 'string DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('slide', 'link');
    }
}
