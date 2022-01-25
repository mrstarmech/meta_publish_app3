<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {
        return $this->render('index');
    }

    public function actionOk() {
        return 'ok';
    }
}
