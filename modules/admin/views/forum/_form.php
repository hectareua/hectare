<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ForumForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => '(не задано)']) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_title_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
