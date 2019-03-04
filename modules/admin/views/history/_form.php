<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use dosamigos\ckeditor\CKEditor;
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
	    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'text_uk')->textarea(['rows' => '6']) ?>
		<?= $form->field($model, 'text_ru')->textarea(['rows' => '6']) ?>  
	</div>
 <?php /*   <?= $form->field($model, 'text_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>
    <?= $form->field($model, 'text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>
 	 */ ?>
    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <div class="form-group clearfix">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
