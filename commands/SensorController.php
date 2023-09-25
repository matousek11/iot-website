<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Expression;

class SensorController extends Controller
{
    /**
     * Calculates average temperature from last 24 hours.
     *
     * @param int $sensorId Id of sensor.
     *
     * @return int Exit code.
     */
    public function actionAverage(int $sensorId): int
    {
        $average = $this->calculateAverage($sensorId);
        if ($average === null) {
            echo "Sensor id doesn’t exists or there’s not enough measurements.\n";
            return ExitCode::DATAERR;
        }
        $this->stdout("Average Temperature for Sensor ID $sensorId: $average" . "°C\n");
        return ExitCode::OK;
    }

    /**
     * Calculate average temperature from last 24 hours.
     *
     * @param int $sensorId Id of sensor.
     *
     * @return float Average temperature from database.
     */
    private function calculateAverage(int $sensorId): float
    {
        $twentyFourHoursAgo = new Expression('NOW() - INTERVAL 1 DAY');
        $averageTemperature = Yii::$app->db->createCommand('
            SELECT AVG(temperature) FROM measurement WHERE sensorId = :sensorId AND time >= :twentyFourHoursAgo
        ', [':sensorId' => $sensorId, ':twentyFourHoursAgo' => $twentyFourHoursAgo,])->queryScalar();

        return $averageTemperature;
    }
}