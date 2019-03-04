<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="well">
        <h3>Для російської версії сайту</h3>
        
        <?= $form->field($model, 'description_ru')->textarea(['rows' => 6,'style'=>'resize:vertical;']) ?>
        <?= $form->field($model, 'link_ru')->textInput() ?>
        <div class="row">
            <?= $form->field($model, 'imageUrlRu', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

            <div class="col-lg-1">або</div>

            <?= $form->field($model, 'imageFileRu', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
        </div>
		<div class="row">
            <?= $form->field($model, 'imageUrlDeskRu', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

            <div class="col-lg-1">або</div>

            <?= $form->field($model, 'imageFileDeskRu', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
        </div>
    </div>

    <br>

    <div class="well">
        <h3>Для української версії сайту</h3>

        <?= $form->field($model, 'description_uk')->textarea(['rows' => 6,'style'=>'resize:vertical;']) ?>
        <?= $form->field($model, 'link_uk')->textInput() ?>

        <div class="row">
            <?= $form->field($model, 'imageUrlUk', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

            <div class="col-lg-1">або</div>

            <?= $form->field($model, 'imageFileUk', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
        </div>
		<div class="row">
            <?= $form->field($model, 'imageUrlDeskUk', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

            <div class="col-lg-1">або</div>

            <?= $form->field($model, 'imageFileDeskUk', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
        </div>
    </div>

    <div class="form-group clearfix">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
