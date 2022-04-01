<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\common\GetClick;

class SiteController extends Controller
{
    static $ApiKey       = '210000010ca4a2321865f666be13c6205ef577ce';
    static $strm_cloaks = [
        '57' => 'https://tblkngs.com/click.php?key=wvr8b8vjlcu7pzmerbe5',
        '58' => 'https://tblkngs.com/click.php?key=qwej9kgi1jijca7l3otp',
        '65' => 'https://tblkngs.com/click.php?key=wvr8b8vjlcu7pzmerbe5',
    ];
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
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
                    $plurl = '';
                    if($click->getLandingUrl() == 'Direct') {
                        $plurl = parse_url($click->getOfferUrl());
                    } else {
                        $plurl = parse_url($click->getLandingUrl());
                    }
                    $path = "/../../storage".$plurl["path"];
                    $query = $plurl["query"];
                    if($query) {
                        parse_str($query, $query_params);
                    }
                    $this->layout = false;
                    return $this->render('indexpl',['root_fld'=>$path, 'path_to_pl'=>Yii::getAlias('@webroot').$path."index.php", 'query_params'=>$query_params]);
                }
            }
        }
        return $this->render('index');
    }

    public function actionOk() {
        return 'ok';
    }
}
