<?php

namespace app\controllers;

use app\models\Article;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

class ArticleController extends Controller
{
    // public $modelClass = 'app\models\Article';

    // public function actions():array {
    //     $actions = parent::actions();
    //     unset($actions['delete'],$actions['create'],$actions['update']);
    //     return $actions;
    // }

    public function actionIndex() {
        $articles = Article::find()->orderBy(new Expression('rand()'))->limit(40)->asArray()->all();
        return json_encode($articles);
    }

    public function actionList($limit) {
        $articles = Article::find()->orderBy(new Expression('rand()'))->limit($limit)->asArray()->all();
        return json_encode($articles);
    }

    public function actionView($id) {
        $article = Article::find()->where(['id'=>$id])->asArray()->one();
        return json_encode($article);
    }

    public function actionViewc($id,$limit=null) {
        $articles = Article::find()->where(['category_id'=>$id])->limit($limit)->orderBy(new Expression('rand()'))->asArray()->all();
        return json_encode($articles);
    }
}
