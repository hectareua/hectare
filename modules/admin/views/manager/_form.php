<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ManagerForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manager-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code1c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'job')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager_type')->dropdownList(array('1'=>'Робітник централього офісу','2'=>'Партнер','3'=>'Робітник магазину')) ?>

    <?//= $form->field($model, 'user_add_id')->dropdownList($headOfManager) ?>

    <?= $form->field($model, 'bd')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Оберіть дату народження ...'],
    'language' => 'ua',
    'removeButton' => false,
    'pickerButton' => ['icon' => 'calendar'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd'
    ]
]); ?>

    <?= $form->field($model, 'date_add')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть дату прийняття на роботу ...'],
        'language' => 'ua',
        'removeButton' => false,
        'pickerButton' => ['icon' => 'calendar'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'carma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'imageUrlTwo', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFileTwo', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
