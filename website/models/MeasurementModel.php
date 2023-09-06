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

    /**
     * Define the attributes and their validation rules.
     */
    public function rules()
    {
        return [
            [['measurementId', 'sensorId', 'temperature', "humidity", "time"], 'required'],
            [['time'], 'integer'],
            [['temperature', "humidity"], 'float'],
        ];
    }

    /**
     * Attribute labels for better display in forms and views.
     */
    public function attributeLabels()
    {
        return [
            'measurementId' => 'Measurement ID',
            'sensorId' => 'Sensor ID',
            'temperature' => 'Temperature',
            'humidity' => 'Humidity',
            "time" => "Time created",
        ];
    }
}