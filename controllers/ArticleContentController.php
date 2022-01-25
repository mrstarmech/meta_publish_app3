<?php

namespace app\controllers;

class ArticleContentController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\ArticleContent';

    public function actions():array {
        $actions = parent::actions();
        unset($actions['delete'],$actions['create'],$actions['update']);
        return $actions;
    }
}
