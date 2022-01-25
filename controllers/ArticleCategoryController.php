<?php

namespace app\controllers;

class ArticleCategoryController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\ArticleCategory';

    public function actions():array {
        $actions = parent::actions();
        unset($actions['delete'],$actions['create'],$actions['update']);
        return $actions;
    }
}
