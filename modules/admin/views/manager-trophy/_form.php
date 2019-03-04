<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manager-trophy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desc_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_ru')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'trophy_type_id')->dropDownList($trophyType) ?>

    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>
	
	<div class="row">
        <h4>Для типу нагороди "Нагороди за продажі"</h4>
    </div>
    <?= $form->field($model, 'min_sale')->textInput(['type' => 'number', 'step' => 50000]) ?>
    <?= $form->field($model, 'max_sale')->textInput(['type' => 'number', 'step' => 50000]) ?>
    <?= $form->field($model, 'step')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
