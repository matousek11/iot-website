<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\SensorModel;
use yii\data\ActiveDataProvider;

class IndexModel extends model
{
    /**
     * @return ActiveDataProvider
     */
    public function getDataProvider()
    {
        $query = SensorModel::find();
        $dataProvider = new ActiveDataProvider([
            "query" => $query,
            "pagination" => [
                "pageSize" => 10
            ]
        ]);
        return $dataProvider;
    }
}