<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'delivery')->checkbox(['label' => 'Безкоштовна доставка']) ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'opps')->checkbox(['label' => 'Официальный производитель']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'off_partner')->checkbox(['label' => 'Официальный партнер']) ?>
        </div>
    </div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'description_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>
    <?= $form->field($model, 'seo_title_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_header_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_header_ru')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'country_id')->dropDownList($country) ?>
    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'code1c')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'exp_roz')->checkbox(['label' => 'Экспорт РОЗЕТКА']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
