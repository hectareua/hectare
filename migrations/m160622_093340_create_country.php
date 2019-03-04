<?php

use yii\db\Migration;

/**
 * Handles the creation for table `country`.
 */
class m160622_093340_create_country extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
            'iso3' => $this->string(3)->notNull(),
            'iso2' => $this->string(2)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('country');
    }
}
