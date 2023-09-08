<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\helpers\SensorHelper;
use app\models\MeasurementModel;

class InsertDataController extends Controller
{
    /**
     * Takes JSON measurement data, validate them and saves them to db.
     *
     * @param int $id Id of sensor.
     *
     * @return string JSON with information about success.
     */
    public function actionIndex(int $id): string
    {
        if (!Yii::$app->request->isPost)
            return $this->createErrorResponse(405, "Only Post method is allowed.");
        $jsonData = Yii::$app->getRequest()->getRawBody();
        $response = json_decode($jsonData, true);

        if ($response === null)
            return $this->createErrorResponse(400, "Invalid JSON format.");

        if (!isset($response["temperature"]) || !isset($response["humidity"]))
            return $this->createErrorResponse(400, "Missing required fields.");

        $sensorHelper = new SensorHelper();
        if (!$sensorHelper->sensorExists($id))
            return $this->createErrorResponse(400, "Sensor not found.");

        $measurement = new MeasurementModel();
        $measurement->sensorId = $id;
        $measurement->temperature = $response["temperature"];
        $measurement->humidity = $response["humidity"];
        $measurement->time = isset($response["time"]) ? $response["time"] : time();

        if (!$measurement->save())
            return $this->createErrorResponse(400, "Unable to save measurement.");

        Yii::$app->response->statusCode = 200;
        return json_encode(["message" => "Measurement saved successfully."]);
    }

    /**
     * Get token and send it to client.
     *
     * @return string Token in JSON.
     */
    public function actionGetToken(): string
    {
        $csrfToken = Yii::$app->request->csrfToken;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return json_encode(['csrfToken' => $csrfToken]);
    }

    /**
     * Creates error response with status code and message.
     *
     * @param int $statusCode Status code.
     * 
     * @param string $errorMessage Description of what happened.
     *
     * @return string JSON with error message.
     */
    public function createErrorResponse(int $statusCode, string $errorMessage): string
    {
        Yii::$app->response->statusCode = $statusCode;
        return json_encode(["error" => $errorMessage]);
    }
}