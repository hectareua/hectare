<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductBonusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-bonus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'image_id') ?>

    <?= $form->field($model, 'name_uk') ?>

    <?= $form->field($model, 'name_ru') ?>

    <?= $form->field($model, 'desc_uk') ?>

    <?php // echo $form->field($model, 'desc_ru') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
