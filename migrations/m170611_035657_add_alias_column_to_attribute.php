<?php

use yii\db\Migration;

/**
 * Handles adding alias_column to table `attribute`.
 */
class m170611_035657_add_alias_column_to_attribute extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('attribute', 'alias', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('attribute', 'alias');
    }
}
