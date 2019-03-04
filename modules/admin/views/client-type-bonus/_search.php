<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ClientTypeBonusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-type-bonus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clientType.name_uk') ?>

    <?= $form->field($model, 'bonus_one') ?>

    <?= $form->field($model, 'bonus_all') ?>
    <?= $form->field($model, 'stage') ?>
    <?= $form->field($model, 'percent_stage') ?>
    <?= $form->field($model, 'money_plan') ?>

    <?= $form->field($model, 'date_from') ?>

    <?php // echo $form->field($model, 'date_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
