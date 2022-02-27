<?php

use yii\db\Migration;

/**
 * Class m220227_124014_create_table_click_browser_details
 */
class m220227_124014_create_table_click_browser_details extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('browserDetails',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'fullVersion'=>$this->string(255),
            'majorVersion'=>$this->string(255),
            'os'=>$this->string(255),
            'osVersion'=>$this->string(255),
            'device'=>$this->string(255),
            'userAgent'=>$this->string(4096)
        ]);
        $this->addForeignKey('clicks_browserDetailsId_browserDetails_id', 'clicks', 'browserDetailsId', 'browserDetails', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('clicks_browserDetailsId_browserDetails_id', 'clicks');
        $this->dropTable('browserDetails');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220227_124014_create_table_click_browser_details cannot be reverted.\n";

        return false;
    }
    */
}
