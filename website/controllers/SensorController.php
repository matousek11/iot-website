<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SensorDetailModel;

class SensorController extends Controller
{
    public function actionDetail($id)
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