<?php

use yii\db\Migration;

/**
 * Handles the creation for table `order`.
 * Has foreign keys to the tables:
 *
 * - `client`
 * - `payment_system`
 * - `order_status`
 * - `country`
 */
class m160622_101107_create_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer(),
            'payment_system_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'ordered_at' => $this->timestamp()->notNull(),
            'billing_fullname' => $this->string(),
            'billing_city' => $this->string(),
            'billing_region' => $this->string(),
            'billing_phone' => $this->string(15),
            'billing_email' => $this->string(),
            'delivery_fullname' => $this->string(),
            'delivery_address' => $this->string(),
            'delivery_city' => $this->string(),
            'delivery_region' => $this->string(),
            'delivery_country_id' => $this->integer(),
            'delivery_phone' => $this->string(15),
            'comment' => $this->text(),
        ]);

        // creates index for column `client_id`
        $this->createIndex(
            'idx-order-client_id',
            'order',
            'client_id'
        );

        // add foreign key for table `client`
        $this->addForeignKey(
            'fk-order-client_id',
            'order',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );

        // creates index for column `payment_system_id`
        $this->createIndex(
            'idx-order-payment_system_id',
            'order',
            'payment_system_id'
        );

        // add foreign key for table `payment_system`
        $this->addForeignKey(
            'fk-order-payment_system_id',
            'order',
            'payment_system_id',
            'payment_system',
            'id',
            'CASCADE'
        );

        // creates index for column `status_id`
        $this->createIndex(
            'idx-order-status_id',
            'order',
            'status_id'
        );

        // add foreign key for table `order_status`
        $this->addForeignKey(
            'fk-order-status_id',
            'order',
            'status_id',
            'order_status',
            'id',
            'CASCADE'
        );

        // creates index for column `delivery_country_id`
        $this->createIndex(
            'idx-order-delivery_country_id',
            'order',
            'delivery_country_id'
        );

        // add foreign key for table `country`
        $this->addForeignKey(
            'fk-order-delivery_country_id',
            'order',
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
        $this->dropTable('order');
    }
}
