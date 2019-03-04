<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeoUrl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-url-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox(['label' => 'Активна']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'h1')->textInput() ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
