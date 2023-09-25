<?php

namespace app\controllers;

use app\models\MeasurementModel;
use app\models\SensorModel;
use Yii;
use yii\web\Controller;
use app\models\SensorDetailModel;

class SensorController extends Controller
{
    /**
     * Provides details about sensor and last 20 measurements from sensor.
     *
     * @param int $id Id of sensor which will be displayed.
     *
     * @return string HTML page with info about sensor and last 20 measurements.
     */
    public function actionDetail($id): string
    {
        $id = $_GET['id'];
        $sensorDetailModel = new SensorDetailModel();
        $data = $sensorDetailModel->getOneSensorData($id);
        if (count($data) !== 0)
            return $this->render('detail', ["sensorDetail" => $data["sensorDetail"], "measurementsDataProvider" => $data["measurementsDataProvider"]]);
        else
            return $this->render("detail", ["sensorDetail" => null, "measurementsDataProvider" => null]);
    }
}