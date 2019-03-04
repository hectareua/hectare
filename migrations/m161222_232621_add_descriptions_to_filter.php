<?php

use yii\db\Migration;

/**
 * Handles adding descriptions to table `filter`.
 */
class m161222_232621_add_descriptions_to_filter extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('filter', 'description_uk', $this->text());
        $this->addColumn('filter', 'description_ru', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('filter', 'description_uk');
        $this->dropColumn('filter', 'description_ru');
    }
}
