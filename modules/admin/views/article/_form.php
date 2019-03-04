<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publishing_since')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Оберіть час публікації статті ...'],
    'language' => 'ua',
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
    'pluginOptions' => [
        'autoclose' => true
    ]
]); ?>

    <?= $form->field($model, 'publishing_till')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Оберіть час завершення публікації статті ...'],
    'language' => 'ua',
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
    'pluginOptions' => [
        'autoclose' => true
    ]
]); ?>

    <?= $form->field($model, 'updated_at')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Оберіть час останнього оновлення ...'],
    'language' => 'ua',
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
    'pluginOptions' => [
        'autoclose' => true
    ]
]); ?>


    <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'seo_title_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
