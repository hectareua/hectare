<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ClientTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_uk') ?>

    <?= $form->field($model, 'order') ?>

    <?= $form->field($model, 'stock') ?>

    <?= $form->field($model, 'arch_order') ?>

    <?php // echo $form->field($model, 'depart_eval') ?>

    <?php // echo $form->field($model, 'vote') ?>

    <?php // echo $form->field($model, 'period_vote') ?>

    <?php // echo $form->field($model, 'worker') ?>

    <?php // echo $form->field($model, 'stock_with_filter') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'shop') ?>

    <?php // echo $form->field($model, 'bonus') ?>

    <?php // echo $form->field($model, 'stock_in_cart') ?>

    <?php // echo $form->field($model, 'partner_price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
