<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ClientTypeBonusRelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-type-bonus-rel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ctype_bonus_id') ?>

    <?= $form->field($model, 'manager_id') ?>

    <?= $form->field($model, 'confirm') ?>

    <?= $form->field($model, 'show_ones') ?>

    <?= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
