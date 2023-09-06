<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\SensorModel;
use app\models\MeasurementModel;
use yii\data\ActiveDataProvider;

class SensorDetailModel extends model
{
    /**
     * @return array
     */
    public function getOneSensorData(int $id)
    {
        $sensor = SensorModel::findOne($id);
        if ($sensor !== null) {
            $measurementsQuery = MeasurementModel::find()->where(["sensorId" => $id])->orderBy(["time" => SORT_DESC])->limit(20);
            $measurementsDataProvider = new ActiveDataProvider([
                "query" => $measurementsQuery,
            ]);
            return ["sensorDetail" => $sensor, "measurementsDataProvider" => $measurementsDataProvider];
        } else
            return [];
    }
}