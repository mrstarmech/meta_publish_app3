<?php

use yii\db\Migration;

/**
 * Class m220227_122905_create_table_click_ip_location
 */
class m220227_122905_create_table_click_ip_location extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ipLocation',[
            'id' => $this->primaryKey(),
            'city' => $this->string(4096),
            'continent' => $this->string(64),
            'country' => $this->string(1024),
            'latitude' => $this->float(),
            'longitude' => $this->float(),
            'postalCode' => $this->string(40),
            'subdivisions' => $this->string(1024),
            'timezone' => $this->string(255)
        ]);
        $this->addForeignKey('clicks_ipLocationId_ipLocation_id', 'clicks', 'ipLocationId', 'ipLocation', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('clicks_ipLocationId_ipLocation_id', 'clicks');
        $this->dropTable('ipLocation');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220227_122905_create_table_click_ip_location cannot be reverted.\n";

        return false;
    }
    */
}
