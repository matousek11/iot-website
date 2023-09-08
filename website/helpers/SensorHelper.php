<?php
namespace app\helpers;

use app\models\SensorModel;

class SensorHelper
{
    /**
     * Check if sensor with selected id exist.
     *
     * @param int $id Id of sensor which will be checked.
     *
     * @return bool True if exists false if not.
     */
    public function sensorExists(int $id): bool
    {
        $sensor = SensorModel::findOne(["sensorId" => $id]);
        if (!$sensor)
            return false;
        else
            return true;
    }
}