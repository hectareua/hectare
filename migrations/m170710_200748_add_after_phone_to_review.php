<?php

use yii\db\Migration;

/**
 * Handles adding after_phone to table `review`.
 */
class m170710_200748_add_after_phone_to_review extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('review', 'rating', $this->smallInteger(2)->defaultValue(5));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('review', 'rating');
    }
}
