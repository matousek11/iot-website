<?php

namespace app\models;

use yii\db\ActiveRecord;

class SensorModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sensor';
    }

    /**
     * Define the attributes and their validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'dateCreated', 'address'], 'required'],
            [['name', 'address'], 'string', 'max' => 255],
            [['dateCreated', "dateUpdated"], 'integer'],
        ];
    }

    /**
     * Attribute labels for better display in forms and views.
     */
    public function attributeLabels()
    {
        return [
            'sensorId' => 'Sensor ID',
            'name' => 'Name',
            'dateCreated' => 'Date Created',
            "dataUpdated" => "Date update",
            'address' => 'Address',
        ];
    }
}