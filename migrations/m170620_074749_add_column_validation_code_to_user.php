<?php

use yii\db\Migration;

/**
 * Handles adding column_validation_code to table `user`.
 */
class m170620_074749_add_column_validation_code_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'validation_code', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'validation_code');
    }
}
