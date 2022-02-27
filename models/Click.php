<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clicks".
 *
 * @property int $id
 * @property string|null $requestId
 * @property string|null $tag
 * @property string|null $linkedId
 * @property string|null $visitorId
 * @property int|null $visitorFound
 * @property int|null $timestamp
 * @property string|null $time
 * @property int|null $incognito
 * @property string|null $url
 * @property string|null $clientReferer
 * @property string|null $ip
 * @property int|null $ipLocationId
 * @property int|null $browserDetailsId
 * @property float|null $confidenceScore
 *
 * @property Browserdetail $browserDetails
 * @property Iplocation $ipLocation
 */
class Click extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clicks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visitorFound', 'timestamp', 'incognito', 'ipLocationId', 'browserDetailsId'], 'integer'],
            [['confidenceScore'], 'number'],
            [['requestId', 'visitorId'], 'string', 'max' => 20],
            [['tag', 'url', 'clientReferer'], 'string', 'max' => 4096],
            [['linkedId', 'time'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 40],
            [['browserDetailsId'], 'exist', 'skipOnError' => true, 'targetClass' => Browserdetail::className(), 'targetAttribute' => ['browserDetailsId' => 'id']],
            [['ipLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Iplocation::className(), 'targetAttribute' => ['ipLocationId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requestId' => 'Request ID',
            'tag' => 'Tag',
            'linkedId' => 'Linked ID',
            'visitorId' => 'Visitor ID',
            'visitorFound' => 'Visitor Found',
            'timestamp' => 'Timestamp',
            'time' => 'Time',
            'incognito' => 'Incognito',
            'url' => 'Url',
            'clientReferer' => 'Client Referer',
            'ip' => 'Ip',
            'ipLocationId' => 'Ip Location ID',
            'browserDetailsId' => 'Browser Details ID',
            'confidenceScore' => 'Confidence Score',
        ];
    }

    /**
     * Gets query for [[BrowserDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrowserDetails()
    {
        return $this->hasOne(Browserdetail::className(), ['id' => 'browserDetailsId']);
    }

    /**
     * Gets query for [[IpLocation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIpLocation()
    {
        return $this->hasOne(Iplocation::className(), ['id' => 'ipLocationId']);
    }
}
