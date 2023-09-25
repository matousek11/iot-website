<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%measurement}}`.
 */
class m230904_122751_create_measurement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%measurement}}', [
            'measurementId' => $this->primaryKey(),
            'sensorId' => $this->integer(),
            'temperature' => $this->float(),
            'humidity' => $this->float(),
            'time' => $this->integer()->defaultValue(time()),
        ]);
        $this->addForeignKey(
            'fk-measurement-sensorId',
            '{{%measurement}}',
            'sensorId',
            '{{%sensor}}',
            'sensorId',
            'CASCADE',
            'CASCADE'
        );
        $this->createIndex('idx-measurement-sensorId', '{{%measurement}}', 'sensorId');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%measurement}}');
    }
}