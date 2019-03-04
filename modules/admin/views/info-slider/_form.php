<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InfoSlider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'link_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_uk')->textarea(['rows' => 5]) ?>

    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
