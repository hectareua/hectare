<?php

use yii\db\Migration;

/**
 * Handles adding city_city_uk to table `representative`.
 */
class m180325_153745_add_city_city_uk_columns_to_representative_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('representative', 'city', $this->string(150));
        $this->addColumn('representative', 'city_uk', $this->string(150));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('representative', 'city');
        $this->dropColumn('representative', 'city_uk');
    }
}
