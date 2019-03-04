<?php

use yii\db\Migration;

/**
 * Handles adding longitude_latitude to table `representative`.
 */
class m180429_103945_add_longitude_latitude_columns_to_representative_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('representative', 'longitude', $this->double());
        $this->addColumn('representative', 'latitude', $this->double());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('representative', 'longitude');
        $this->dropColumn('representative', 'latitude');
    }
}
