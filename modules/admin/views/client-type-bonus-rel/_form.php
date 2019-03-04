<?php

use app\models\ClientTypeBonus;
use app\models\Manager;
use app\models\User;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonusRel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-type-bonus-rel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ctype_bonus_id')->dropDownList(ArrayHelper::map(ClientTypeBonus::find()->all(),'id','name_bonus_uk')) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'client.BillingFullName')) ?>

    <?= $form->field($model, 'confirm')->dropDownList(array('1'=> 'Так', '0' => 'Ні')) ?>

    <?= $form->field($model, 'show_ones')->dropDownList(array('1'=> 'Так', '0' => 'Ні')) ?>

    <?= $form->field($model, 'created_at')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Дата підтвердження...'],
        'language' => 'uk',
        'removeButton' => false,
        'pickerButton' => ['icon' => 'calendar'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
