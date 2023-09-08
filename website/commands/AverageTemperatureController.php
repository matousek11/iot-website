<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

class AverageTemperatureController extends Controller
{
    public function actionAverage($sensorId)
    {
        $average = $this->calculateAverage($sensorId);

        $this->stdout("Average Temperature for Sensor ID $sensorId: $average\n");
    }

    private function calculateAverage($sensorId)
    {
        $twentyFourHoursAgo = new Expression('NOW() - INTERVAL 1 DAY');
        $averageTemperature = Yii::$app->db->createCommand('
            SELECT AVG(temperature) FROM measurement WHERE sensorId = :sensorId AND time >= :twentyFourHoursAgo
        ', [':sensorId' => $sensorId, ':twentyFourHoursAgo' => $twentyFourHoursAgo,])->queryScalar();

        return $averageTemperature;
    }
}