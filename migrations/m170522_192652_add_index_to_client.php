<?php

use yii\db\Migration;

/**
 * Handles adding index to table `client`.
 */
class m170522_192652_add_index_to_client extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createIndex(
            'idx-client_user_id',
            'client',
            'user_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-client_user_id',
            'user_id'
        );
    }
}
