<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderBonus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-bonus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($user) ?>

    <?= $form->field($model, 'product_bonus_id')->dropDownList($product) ?>

    <?= $form->field($model, 'price')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'ordered_at')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть час замовлення ...'],
        'language' => 'uk',
        'removeButton' => false,
        'pickerButton' => ['icon' => 'time'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
