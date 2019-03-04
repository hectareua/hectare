<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\models\Credit;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Credit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
  <?php 

  $items = [];
    $items['Главная'] = [
        '0' => 'Главная'
    ];
    $items['Разделы'] = ArrayHelper::map(Credit::find()->where(['parent_id' => 0])->indexBy('id')->all(), 'id', 'name_ru');

    $params = [
        'prompt' => 'Выберите меню...',
    ];


   ?>
    <?= $form->field($model, 'parent_id')->dropdownList($items, $params) ?>

    <?= $form->field($model, 'desk_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'desk_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'credit_percent')->textInput(['type' => 'double']) ?>
    <?= $form->field($model, 'period')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
