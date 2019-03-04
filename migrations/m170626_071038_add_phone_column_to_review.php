<?php

use yii\db\Migration;

/**
 * Handles adding phone_column to table `review`.
 */
class m170626_071038_add_phone_column_to_review extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('review', 'phone', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('review', 'phone');
    }
}
