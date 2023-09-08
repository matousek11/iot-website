<?php

/** @var yii\web\View $this */

$this->title = 'Measurement input';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Measurement detail</h1>
        <p class="lead">
            <?= $text ?>
        </p>
    </div>

    <div class="body-content mx-auto" style="max-width: 300px">
        <?php
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;

        $form = ActiveForm::begin();
        echo $form->field($model, "temperature")->textInput(["type" => "number", 'step' => '0.01']);
        echo $form->field($model, "humidity")->textInput(["type" => "number", 'step' => '0.01']);
        echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);
        ActiveForm::end();
        ?>
    </div>
</div>