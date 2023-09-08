<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Expression;

class SensorController extends Controller
{
    public function actionAverage($sensorId)
    {
        $average = $this->calculateAverage($sensorId);
        if ($average === null) {
            echo "Sensor id doesn’t exists or there’s not enough measurements.\n";
            return ExitCode::DATAERR;
        }
        $this->stdout("Average Temperature for Sensor ID $sensorId: $average" . "°C\n");
        return ExitCode::OK;
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