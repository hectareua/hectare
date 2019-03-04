<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
		<?= $form->field($model, 'text_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
		<?= $form->field($model, 'text_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>
	</div>
    <div class="form-group clearfix">
        <?= Html::submitButton('Редагувати', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
