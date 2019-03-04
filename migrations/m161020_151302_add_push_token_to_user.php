<?php

use yii\db\Migration;

/**
 * Handles adding push_token to table `user`.
 */
class m161020_151302_add_push_token_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'push_token', 'text DEFAULT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'push_token');
    }
}
