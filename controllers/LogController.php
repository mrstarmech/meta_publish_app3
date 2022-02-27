<?php

namespace app\controllers;

use app\models\Browserdetail;
use app\models\Click;
use app\models\IpLocation;
use Yii;

class LogcController extends \yii\web\Controller
{
    public $layout = 'log';

    public function actionIndex() {
        if(Yii::$app->user->isGuest) return $this->redirect('/cms/login');
        if(Yii::$app->user->id !== '102') return $this->redirect('/cms/login');
        $order = isset($_GET['order']) ? $_GET['order'] : null;
        $clicks = Click::find();
        if($order) {
            $clicks = $clicks->orderBy("$order ASC");
        }
        return $this->render('index', ['clicks'=> $clicks->all()]);
    }

    public function actionDetail($id) {
        $click = Click::find()->where(['id'=>$id])->one();
        return $this->render('detail',['click'=>$click]);
    }
}