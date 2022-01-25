<?php

use yii\db\Migration;

/**
 * Class m220119_052909_create_table_articlecontent
 */
class m220119_052909_create_table_articlecontent extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articlecontent', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articlecontent');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220119_052909_create_table_articlecontent cannot be reverted.\n";

        return false;
    }
    */
}
