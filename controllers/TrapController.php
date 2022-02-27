<?php

namespace app\controllers;

use app\models\Browserdetail;
use app\models\Click;
use app\models\IpLocation;
use Yii;

class TrapController extends \yii\rest\Controller
{
    public function actionLog()
    {
        if(Yii::$app->request->isPost) {
            $data = json_decode(file_get_contents('php://input'),true);
            if($data === null) return 'data null';
            $model = new Click();
            $model->requestId = $data['requestId'];
            $model->tag = json_encode($data['tag']);
            $model->linkedId = $data['linkedId'];
            $model->visitorId = $data['visitorId'];
            $model->visitorFound = intval(boolval($data['visitorFound']));
            $model->timestamp = intval($data['timestamp']);
            $model->time = date('d-m-Y|Gi.s', intval($data['timestamp']));
            $model->incognito = intval(boolval($data['incognito']));
            $model->url = $data['url'];
            $model->clientReferer = $data['clientReferrer'];
            $model->ip = $data['ip'];
            $ipLocation = new IpLocation();
            $dataIpLocation = $data['ipLocation'];
            $ipLocation->city = json_encode($dataIpLocation['city']);
            $ipLocation->continent = json_encode($dataIpLocation['continent']);
            $ipLocation->country = json_encode($dataIpLocation['country']);
            $ipLocation->latitude = floatval($dataIpLocation['latitude']);
            $ipLocation->longitude = floatval($dataIpLocation['longitude']);
            $ipLocation->postalCode = $dataIpLocation['postalCode'];
            $ipLocation->subdivisions = json_encode($dataIpLocation['subdivisions']);
            $ipLocation->timezone = $dataIpLocation['timezone'];
            if($ipLocation->save()) {
                $model->ipLocationId = $ipLocation->id;
            } else {
                $model->ipLocationId = -1;
            }
            $browserDetails = new Browserdetail();
            $dataBrowserDetails = $data['browserDetails'];
            $browserDetails->name = $dataBrowserDetails['browserName'];
            $browserDetails->fullVersion = $dataBrowserDetails['browserFullVersion'];
            $browserDetails->majorVersion = $dataBrowserDetails['browserMajorVersion'];
            $browserDetails->os = $dataBrowserDetails['os'];
            $browserDetails->osVersion = $dataBrowserDetails['osVersion'];
            $browserDetails->device = $dataBrowserDetails['device'];
            $browserDetails->userAgent = $dataBrowserDetails['userAgent'];
            if($browserDetails->save()) {
                $model->browserDetailsId = $browserDetails->id;
            } else {
                $model->browserDetailsId = -1;
            }
            $model->confidenceScore = floatval($data['confidence']['score']);

            if($model->save()) {
                return true;
            } else {
                return $model->errors;
            }
        }
        return false;
    }

}
