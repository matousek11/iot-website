<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Expression;

class TemperatureController extends Controller
{
    public function actionTemperatureAverage($id)
    {
        $twentyFourHoursAgo = new Expression('NOW() - INTERVAL 1 DAY');
        $averageTemperature = Yii::$app->db->createCommand('
            SELECT AVG(temperature) FROM measurement WHERE sensorId = :sensorId AND time >= :twentyFourHoursAgo
        ', [':sensorId' => $id, ':twentyFourHoursAgo' => $twentyFourHoursAgo,])->queryScalar();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ["average" => $averageTemperature];
    }
}