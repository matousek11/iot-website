<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\SensorModel;
use app\models\MeasurementModel;

class InsertDataController extends Controller
{
    public function actionIndex(int $id)
    {
        if (!Yii::$app->request->isPost)
            return $this->createError(405, "Only Post method is allowed.");
        $jsonData = Yii::$app->getRequest()->getRawBody();
        $response = json_decode($jsonData, true);

        if ($response === null)
            return $this->createError(400, "Invalid JSON format.");

        if (!isset($response["temperature"]) || !isset($response["humidity"]))
            return $this->createError(400, "Missing required fields.");

        if (!$this->sensorExists($id))
            return $this->createError(400, "Sensor not found.");

        $measurement = new MeasurementModel();
        $measurement->sensorId = $id;
        $measurement->temperature = $response["temperature"];
        $measurement->humidity = $response["humidity"];
        $measurement->time = isset($response["time"]) ? $response["time"] : time();

        if (!$measurement->save())
            return $this->createError(400, "Unable to save measurement.");

        $csrfToken = Yii::$app->request->csrfToken;

        Yii::$app->response->statusCode = 200;
        return json_encode(["message" => "Measurement saved successfully."]);
    }

    public function actionGetToken()
    {
        $csrfToken = Yii::$app->request->csrfToken;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['csrfToken' => $csrfToken];
    }

    public function sensorExists(int $id): bool
    {
        $sensor = SensorModel::findOne(["sensorId" => $id]);
        if (!$sensor)
            return false;
        else
            return true;
    }

    public function createError(int $statusCode, string $errorMessage): string
    {
        Yii::$app->response->statusCode = $statusCode;
        return json_encode(["error" => $errorMessage]);
    }
}