<?php

use yii\db\Migration;

/**
 * Handles adding path to table `image`.
 */
class m160927_072916_add_path_to_image extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('image', 'path', 'string');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('image', 'path');
    }
}
