<?php

use yii\db\Migration;

/**
 * Handles the creation for table `field`.
 */
class m160623_075038_create_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('field', [
            'id' => $this->primaryKey(),
            'name_uk' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('field');
    }
}
