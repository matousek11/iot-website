<?php
namespace app\controllers;

use app\models\MeasurementModel;
use app\models\SensorModel;
use app\helpers\SensorHelper;
use Yii;
use yii\web\Controller;

class MeasurementController extends Controller
{
    /**
     * Provides input form for new measurement from users.
     *
     * @param int $id Id of sensor from which is measurement.
     *
     * @return string HTML page with form.
     */
    public function actionInsertData($id): string
    {
        $sensorHelper = new SensorHelper();
        $measurementModel = new MeasurementModel();
        $measurementModel->sensorId = $id;
        $measurementModel->time = time();
        //form send
        if ($measurementModel->load(Yii::$app->request->post()) && $measurementModel->validate()) {
            if ($sensorHelper->sensorExists($id)) {
                if ($measurementModel->save()) {
                    //success
                    return $this->render("insertData", ["model" => $measurementModel, "text" => "Measurement Successfully saved."]);
                }
            }
            //failure
            return $this->render("insertData", ["model" => $measurementModel, "text" => "Something gone wrong."]);
        } else {
            //initial load
            return $this->render("insertData", ["model" => $measurementModel, "text" => "Sensor detail page with last 20 measurements."]);
        }
    }
}