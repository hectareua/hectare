<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'payment_system_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'ordered_at') ?>

    <?= $form->field($model, 'is_one_c_order') ?>

    <?php // echo $form->field($model, 'billing_fullname') ?>

    <?php // echo $form->field($model, 'billing_city') ?>

    <?php // echo $form->field($model, 'billing_region') ?>

    <?php // echo $form->field($model, 'billing_phone') ?>

    <?php // echo $form->field($model, 'billing_email') ?>

    <?php // echo $form->field($model, 'delivery_fullname') ?>

    <?php // echo $form->field($model, 'delivery_address') ?>

    <?php // echo $form->field($model, 'delivery_city') ?>

    <?php // echo $form->field($model, 'delivery_region') ?>

    <?php // echo $form->field($model, 'delivery_country_id') ?>

    <?php // echo $form->field($model, 'delivery_phone') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
