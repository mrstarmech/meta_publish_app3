<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "iplocation".
 *
 * @property int $id
 * @property string|null $city
 * @property string|null $continent
 * @property string|null $country
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $postalCode
 * @property string|null $subdivisions
 * @property string|null $timezone
 *
 * @property Click[] $clicks
 */
class IpLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'iplocation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['city'], 'string', 'max' => 4096],
            [['continent'], 'string', 'max' => 64],
            [['country', 'subdivisions'], 'string', 'max' => 1024],
            [['postalCode'], 'string', 'max' => 40],
            [['timezone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'continent' => 'Continent',
            'country' => 'Country',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'postalCode' => 'Postal Code',
            'subdivisions' => 'Subdivisions',
            'timezone' => 'Timezone',
        ];
    }

    /**
     * Gets query for [[Clicks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClicks()
    {
        return $this->hasMany(Click::className(), ['ipLocationId' => 'id']);
    }
}
