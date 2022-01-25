<?php

use yii\db\Migration;

/**
 * Class m220119_053136_create_table_articlecategory
 */
class m220119_053136_create_table_articlecategory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articlecategory', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articlecategory');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220119_053136_create_table_articlecategory cannot be reverted.\n";

        return false;
    }
    */
}
