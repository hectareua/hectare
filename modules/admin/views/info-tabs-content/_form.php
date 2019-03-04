<?php

use dosamigos\ckeditor\CKEditor;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use dosamigos\ckeditor\CKEditor;
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <?= $form->field($model, 'info_tabs_id')->dropDownList($infoTabs) ?>
        <?= $form->field($model, 'number')->textInput() ?>
	    <?= $form->field($model, 'header_uk')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'header_ru')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'desc_uk')->textarea(['rows' => '6']) ?>
		<?= $form->field($model, 'desc_ru')->textarea(['rows' => '6']) ?>
        <?= $form->field($model, 'text_uk')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ])  ?>
        <?= $form->field($model, 'text_ru')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ])  ?>
        <?= $form->field($model, 'author_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'author_ru')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'seo_title_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'seo_title_ru')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'seo_keywords_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'seo_keywords_ru')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'seo_description_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'seo_description_ru')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'views')->textInput() ?>
        <?= $form->field($model, 'main_visible')->checkbox() ?>
	</div>
 <?php /*   <?= $form->field($model, 'text_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>
    <?= $form->field($model, 'text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>
 	 */ ?>
    <div class="row">
        <?= $form->field($model, 'imageUrl', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <div class="row" style="background: #afd9ee">
        <h4>Для малого зображення, яке відображається в категоріях</h4>
        <?= $form->field($model, 'imageUrlTwo', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'imageFileTwo', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <?= $form->field($model, 'video')->textarea(['rows' => '5']) ?>

    <div class="row">
        <?= $form->field($model, 'pdf_url', ['options' => ['class' => 'col-lg-8']])->textInput() ?>

        <div class="col-lg-1">або</div>

        <?= $form->field($model, 'pdfFile', ['options' => ['class' => 'col-lg-3']])->fileInput() ?>
    </div>

    <?= $form->field($model, 'imagesData')->widget(MultipleInput::className(), [
        'max'             => 10,
        'columns'           => [
            [
                'name'      =>  'imageUrl',
                'title'     =>  'Url зображеня',
                'type'      =>  'textInput',
            ],
            [
                'name'      =>  'imageFile',
                'title'     =>  'Файл зображеня',
                'type'      =>  'fileInput',
            ],
            [
                'name'      =>  'id',
                'type'      =>  'hiddenInput',
            ],
        ],
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        'min'               => 1,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
    ])->label(false) ?>

    <div class="form-group clearfix">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
