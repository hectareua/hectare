<?php

use yii\db\Migration;

/**
 * Handles adding i18n to table `slide_table`.
 */
class m160927_115855_add_i18n_to_slide_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('slide', 'description');
        $this->addColumn('slide', 'description_uk', 'text');
        $this->addColumn('slide', 'description_ru', 'text');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('slide', 'description_uk');
        $this->dropColumn('slide', 'description_ru');
        $this->addColumn('slide', 'description', 'text');
    }
}
