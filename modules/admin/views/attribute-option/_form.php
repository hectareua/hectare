<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AttributeOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attribute_id')->dropDownList($attributes) ?>

    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'multiplier')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
