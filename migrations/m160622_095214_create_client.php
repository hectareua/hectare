<?php

use yii\db\Migration;

/**
 * Handles the creation for table `client`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `country`
 * - `country`
 */
class m160622_095214_create_client extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'billing_first_name' => $this->string(),
            'billing_last_name' => $this->string(),
            'billing_middle_name' => $this->string(),
            'billing_address' => $this->text(),
            'billing_city' => $this->string(),
            'billing_postcode' => $this->string(),
            'billing_region' => $this->string(),
            'billing_country_id' => $this->integer(),
            'billing_phone' => $this->string(15),
            'delivery_first_name' => $this->string(),
            'delivery_last_name' => $this->string(),
            'delivery_middle_name' => $this->string(),
            'delivery_address' => $this->text(),
            'delivery_city' => $this->string(),
            'delivery_postcode' => $this->string(),
            'delivery_region' => $this->string(),
            'delivery_country_id' => $this->integer(),
            'delivery_phone' => $this->string(15),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-client-user_id',
            'client',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-client-user_id',
            'client',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `billing_country_id`
        $this->createIndex(
            'idx-client-billing_country_id',
            'client',
            'billing_country_id'
        );

        // add foreign key for table `country`
        $this->addForeignKey(
            'fk-client-billing_country_id',
            'client',
            'billing_country_id',
            'country',
            'id',
            'CASCADE'
        );

        // creates index for column `delivery_country_id`
        $this->createIndex(
            'idx-client-delivery_country_id',
            'client',
            'delivery_country_id'
        );

        // add foreign key for table `country`
        $this->addForeignKey(
            'fk-client-delivery_country_id',
            'client',
            'delivery_country_id',
            'country',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('client');
    }
}
