<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="country-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'plant_id') ?>

    <?= $form->field($model, 'phase_id') ?>

    <?= $form->field($model, 'problem_id') ?>

    <?= $form->field($model, 'product_id') ?>
    <?= $form->field($model, 'sector_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
