<?php

use yii\db\Migration;

/**
 * Handles adding descriptions to table `manufacturer`.
 */
class m161222_232516_add_descriptions_to_manufacturer extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('manufacturer', 'description_uk', $this->text());
        $this->addColumn('manufacturer', 'description_ru', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('manufacturer', 'description_uk');
        $this->dropColumn('manufacturer', 'description_ru');
    }
}
