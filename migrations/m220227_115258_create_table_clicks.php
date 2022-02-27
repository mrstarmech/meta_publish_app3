<?php

use yii\db\Migration;

/**
 * Class m220227_115258_create_table_clicks
 */
class m220227_115258_create_table_clicks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clicks', [
            'id' => $this->primaryKey(),
            'requestId' => $this->string(20),
            'tag' => $this->string(4096),
            'linkedId' => $this->string(255),
            'visitorId' => $this->string(20),
            'visitorFound' => $this->boolean(),
            'timestamp' => $this->integer(),
            'time' => $this->string(),
            'incognito' => $this->boolean(),
            'url' => $this->string(4096),
            'clientReferer' => $this->string(4096),
            'ip' => $this->string(40),
            'ipLocationId' => $this->integer(),
            'browserDetailsId' => $this->integer(),
            'confidenceScore' => $this->float()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('clicks');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220227_115258_create_table_clicks cannot be reverted.\n";

        return false;
    }
    */
}
