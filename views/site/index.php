<?php

/** @var yii\web\View $this */

$this->title = 'IOT website';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">IOT-Website</h1>
        <p class="lead">List of all connected IOT sensors.</p>
    </div>

    <div class="body-content">
        <?php
        use kartik\grid\GridView;

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['attribute' => 'name', 'label' => 'Name of sensor'],
                ['attribute' => 'address', 'label' => 'Address of sensor'],
            ],
        ]);
        ?>
    </div>
</div>