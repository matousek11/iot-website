<?php

namespace app\models;

use yii\db\ActiveRecord;

class MeasurementModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measurement';
    }

    public function rules()
    {
        return [
            [['sensorId', 'temperature', 'humidity'], 'required'],
            [['sensorId'], 'integer'],
            [['temperature', 'humidity'], 'double'],
            [['time'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'sensorId' => 'Sensor ID',
            'temperature' => 'Temperature',
            'humidity' => 'Humidity',
            'time' => 'Time Created',
        ];
    }
}