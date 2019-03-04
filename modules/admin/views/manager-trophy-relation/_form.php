<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophyRelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manager-trophy-relation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manager_id')->dropDownList($manager) ?>

    <?= $form->field($model, 'manager_trophy_id')->dropDownList($trophy) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
