<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'c_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_approved')->checkbox() ?>

    <?= $form->field($model, 'c_rating')->textInput() ?>

    <?= $form->field($model, 'c_body')->textarea(['rows' => 1]) ?>
	
	<?= $form->field($model, 'c_type')->dropDownList([ 1 => 'Email', 0 => 'Telefon' ], ['prompt' => 'Выберите тип']) ?>

    <?= $model->isNewRecord ? '' : $form->field($model, 'c_created')->textInput() ?>

    <?= $model->isNewRecord ? '' :$form->field($model, 'c_amended')->textInput() ?>

    <?= $model->isNewRecord ? '' : $form->field($model, 'c_deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
