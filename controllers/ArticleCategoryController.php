<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleCategory;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex() {
        $categories = ArticleCategory::find()->all();
        $tosend = [];
        foreach($categories as $category) {
            if($category->count > 0) {
                array_push($tosend, ['id'=>$category->id,'name'=>$category->name]);
            }
        }
        return json_encode($tosend);
    }

    public function actionView($id) {
        $category = ArticleCategory::find()->where(['id' => $id])->one();
        $tosend = [
            'id' => $category->id,
            'name' => $category->name
        ];
        return json_encode($tosend);
    }
}
