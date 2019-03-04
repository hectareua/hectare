<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox(['label' => 'Заблокована']) ?>
    
    <?= $form->field($model, 'delivery')->checkbox(['label' => 'Безкоштовна доставка']) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parents, ['prompt' => '(не задано)']) ?>

    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'description_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'description_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'seo_title_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_header_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_header_ru')->textInput(['maxlength' => true]) ?>
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
