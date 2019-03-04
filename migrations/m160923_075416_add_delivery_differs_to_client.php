<?php

use yii\db\Migration;

/**
 * Handles adding delivery_differs to table `client`.
 */
class m160923_075416_add_delivery_differs_to_client extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('client', 'delivery_differs', 'boolean');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('client', 'delivery_differs');
    }
}
