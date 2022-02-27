<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "browserdetails".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $fullVersion
 * @property string|null $majorVersion
 * @property string|null $os
 * @property string|null $osVersion
 * @property string|null $device
 * @property string|null $userAgent
 *
 * @property Click[] $clicks
 */
class BrowserDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'browserDetails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'fullVersion', 'majorVersion', 'os', 'osVersion', 'device'], 'string', 'max' => 255],
            [['userAgent'], 'string', 'max' => 4096],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'fullVersion' => 'Full Version',
            'majorVersion' => 'Major Version',
            'os' => 'Os',
            'osVersion' => 'Os Version',
            'device' => 'Device',
            'userAgent' => 'User Agent',
        ];
    }

    /**
     * Gets query for [[Clicks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClicks()
    {
        return $this->hasMany(Click::className(), ['browserDetailsId' => 'id']);
    }
}
