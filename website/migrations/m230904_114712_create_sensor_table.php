<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sensor}}`.
 */
class m230904_114712_create_sensor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sensor}}', [
            'sensorId' => $this->primaryKey(),
            'name' => $this->string(),
            'dateCreated' => $this->integer()->notNull()->defaultValue(time()),
            'dateUpdated' => $this->integer()->defaultValue(time()),
            'address' => $this->string(),
        ]);
        $this->createIndex('idx-sensor-sensorId', '{{%sensor}}', 'sensorId');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sensor}}');
    }
}