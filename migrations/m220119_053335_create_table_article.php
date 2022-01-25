<?php

use yii\db\Exception;
use yii\db\Migration;

/**
 * Class m220119_053335_create_table_article
 */
class m220119_053335_create_table_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article',[
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'date' => $this->string()->notNull(),
            'thumbnail' => $this->string()->notNull(),
            'thumbstring' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'content_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('article_category_id', 'article', 'category_id', 'articlecategory', 'id');
        $this->addForeignKey('article_content_id', 'article', 'content_id', 'articlecontent', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try {
            $this->dropForeignKey('article_category_id', 'article');
            $this->dropForeignKey('article_content_id', 'article');
            $this->dropTable('article');
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220119_053335_create_table_article cannot be reverted.\n";

        return false;
    }
    */
}
