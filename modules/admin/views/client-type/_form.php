<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>
        <div class="col-md-6">
            <?= $form->field($model, 'order')->checkbox() ?>

            <?= $form->field($model, 'stock')->checkbox() ?>

            <?= $form->field($model, 'arch_order')->checkbox() ?>

            <?= $form->field($model, 'depart_eval')->checkbox() ?>

            <?= $form->field($model, 'vote')->checkbox() ?>

            <?= $form->field($model, 'period_vote')->textInput() ?>

            <?= $form->field($model, 'worker')->checkbox() ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'stock_with_filter')->checkbox() ?>

            <?= $form->field($model, 'rating')->checkbox() ?>

            <?= $form->field($model, 'shop')->checkbox() ?>

            <?= $form->field($model, 'bonus')->checkbox() ?>

            <?= $form->field($model, 'stock_in_cart')->checkbox() ?>

            <?= $form->field($model, 'partner_price')->checkbox() ?>

            <?= $form->field($model, 'create_order')->checkbox() ?>

            <?= $form->field($model, 'document')->checkbox() ?>

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
