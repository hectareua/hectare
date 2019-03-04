<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'c_id') ?>

    <?= $form->field($model, 'c_name') ?>

    <?= $form->field($model, 'c_approved') ?>

    <?= $form->field($model, 'c_rating') ?>

    <?= $form->field($model, 'c_body') ?>
	
	<?= $form->field($model, 'c_type') ?>

    <?php // echo $form->field($model, 'c_created') ?>

    <?php // echo $form->field($model, 'c_amended') ?>

    <?php // echo $form->field($model, 'c_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
