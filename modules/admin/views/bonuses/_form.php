<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
		<?= $form->field($model, 'one_title_ru')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'one_title_uk')->textInput(['maxlength' => true])?>
		<?= $form->field($model, 'one_content_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'one_content_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'mob_text_title_ru')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'mob_text_title_uk')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'mob_text_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'mob_text_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'two_title_ru')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'two_title_uk')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'two_content_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'two_content_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'three_title_ru')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'three_title_uk')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'three_content_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'three_content_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'four_content_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
        <?= $form->field($model, 'four_content_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
	</div>
    <div class="form-group clearfix">
        <?= Html::submitButton('Редагувати', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
