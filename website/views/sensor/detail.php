<?php
use kartik\grid\GridView;

/** @var yii\web\View $this */

$this->title = 'Sensor detail';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Sensor detail</h1>
        <p class="lead">Sensor detail page with last 20 measurements.</p>
    </div>

    <div class="body-content">
        <h3>
            <?php
            if ($sensorDetail !== null)
                echo $sensorDetail["name"];
            ?>
        </h3>
        <p class="mb-0">
            Address:
            <?php
            if ($sensorDetail !== null)
                echo $sensorDetail["address"];
            ?>
        </p>
        <p>
            Date created:
            <?php
            if ($sensorDetail !== null) {
                $date = getdate($sensorDetail["dateCreated"]);
                echo $date["mday"] . "." . $date["mon"] . "." . $date["year"];
            }
            ?>
        </p>
        <?php
        if ($measurementsDataProvider !== null)
            echo GridView::widget([
                'dataProvider' => $measurementsDataProvider,
                'columns' => [
                    ['attribute' => 'temperature', 'label' => 'Temperature(°C)'],
                    ['attribute' => 'humidity', 'label' => 'Humidity(%)'],
                    ['attribute' => 'time', 'label' => 'Date', "format" => ["date", 'php:d.m.Y']],
                ],
            ]);
        ?>
    </div>
</div>