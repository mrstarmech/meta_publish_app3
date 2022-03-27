<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\common\GetClick;

class SiteController extends Controller
{
    static $ApiKey       = '210000010ca4a2321865f666be13c6205ef577ce';
    static $strm_cloaks = [
        '57' => 'https://tblkngs.com/click.php?key=wvr8b8vjlcu7pzmerbe5'
    ];
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {
        $params = Yii::$app->requestedParams;
        if(isset($params["id"])) {            
            if (isset(SiteController::$strm_cloaks[$params['id']])) {
                $click = new GetClick(SiteController::$strm_cloaks[$params['id']], SiteController::$ApiKey);
                if($click instanceof GetClick && array_key_exists('path', $click->DataClick) && $click->DataClick['path']['name'] !== 'White') {
                    if($click->getLandingUrl() == 'Direct') {
                        return $this->redirect($click->getOfferUrl());
                    }
                    return $this->redirect($click->getLandingUrl());
                }
            }
        }
        return $this->render('index');
    }

    public function actionOk() {
        return 'ok';
    }
}
