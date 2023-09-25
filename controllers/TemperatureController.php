<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Expression;

class TemperatureController extends Controller
{
    /**
     * Provides average temperature from sensor from last 24 hours.
     *
     * @param int $id Id of sensor from which measurements are.
     *
     * @return string JSON with average temperature from sensor from last 24 hours.
     */
    public function actionTemperatureAverage($id): string
    {
        $twentyFourHoursAgo = new Expression('NOW() - INTERVAL 1 DAY');
        $averageTemperature = Yii::$app->db->createCommand('
            SELECT AVG(temperature) FROM measurement WHERE sensorId = :sensorId AND time >= :twentyFourHoursAgo
        ', [':sensorId' => $id, ':twentyFourHoursAgo' => $twentyFourHoursAgo,])->queryScalar();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ["average" => $averageTemperature];
    }
}