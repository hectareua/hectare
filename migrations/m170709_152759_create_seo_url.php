<?php

use yii\db\Migration;

/**
 * Handles the creation for table `seo_url`.
 */
class m170709_152759_create_seo_url extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('seo_url', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'title' => $this->text(),
            'h1' => $this->text(),
            'keywords' => $this->text(),
            'description' => $this->text(),
            'text' => $this->text(),
            'status' => $this->smallInteger(2)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('seo_url');
    }
}
