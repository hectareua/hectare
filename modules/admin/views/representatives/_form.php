<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Representative */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="representative-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'region_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'city_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'schedule')->textInput(['maxlength' => true]) ?>
    <div class="row">
      <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

     <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
