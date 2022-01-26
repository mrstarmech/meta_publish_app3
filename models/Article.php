<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $date
 * @property string $thumbnail
 * @property string $thumbstring
 * @property int $category_id
 * @property int $content_id
 *
 * @property ArticleСategory $category
 * @property ArticleСontent $content
 */
class Article extends \yii\db\ActiveRecord
{
    public $actual_content;
    public $file_input;
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author', 'date', 'thumbnail', 'thumbstring', 'category_id', 'content_id'], 'required'],
            [['date'], 'string'],
            [['has_files'], 'boolean'],
            [['category_id', 'content_id'], 'integer'],
            [['title', 'author', 'thumbnail', 'thumbstring'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['content_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleContent::class, 'targetAttribute' => ['content_id' => 'id']],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, jfif, webp', 'maxFiles'=>128],
            [['file_input'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, jfif, webp'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'date' => 'Date',
            'thumbnail' => 'Thumbnail',
            'thumbstring' => 'Thumbstring',
            'category_id' => 'Category ID',
            'content_id' => 'Content ID',
            'actual_content' => 'Content',
            'file_input' => 'Load New Thumbnail',
            'imageFiles' => 'Additional Images'
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'category_id']);
    }
    
    /**
     * Gets query for [[Content]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(ArticleContent::class, ['id' => 'content_id']);
    }
}
