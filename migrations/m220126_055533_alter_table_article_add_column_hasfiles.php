<?php

use yii\db\Migration;

/**
 * Class m220126_055533_alter_table_article_add_column_hasfiles
 */
class m220126_055533_alter_table_article_add_column_hasfiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'has_files', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'has_files');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220126_055533_alter_table_article_add_column_hasfiles cannot be reverted.\n";

        return false;
    }
    */
}
