<?php

use yii\db\Migration;

/**
 * Handles adding representative_id to table `stock1c`.
 */
class m180325_112617_add_representative_id_column_to_stock1c_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('stock1c', 'representative_id', $this->integer()->defaultValue(null)->after('id'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('stock1c', 'representative_id');
    }
}
