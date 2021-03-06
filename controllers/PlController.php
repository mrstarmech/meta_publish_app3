<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class PlController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionView($id='')
    {
        $this->layout = false;
        if($id !== '') {
            $path = Yii::getAlias('@webroot')."/../../storage/pl/$id/index.php";
            if(file_exists($path)){
                return $this->render('index',['root_fld'=>"/storage/pl/$id/", 'path_to_pl'=>$path]);
            }
            return "file not found on $path";
        }
        return $this->redirect('site/index');
    }

    public function actionTs($id) {
        $resp = json_decode(file_get_contents("https://rotation-heart.losmetas.team/render/widget/?widget_key=$id"),true);
        shuffle($resp);
        return json_encode($resp[0]);
    }

    public function actionTsg($id) {
        return $this->redirect("https://rotation-heart.losmetas.team/redirect/widget?key=$id");
    }
}
