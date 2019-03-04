<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Редагувати інформацію сайту';
$this->params['breadcrumbs'][] = ['label' => 'Інформація сайту', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="contact-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="contact-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'about_us_image')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'about_us_title_uk')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'about_us_title_ru')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'about_us_text_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

	    <?= $form->field($model, 'about_us_text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

	    <?= $form->field($model, 'partners_text_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

	    <?= $form->field($model, 'partners_text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

		<?= $form->field($model, 'bonus_text_uk')->widget(CKEditor::className(), [
			'options' => ['rows' => 4],
			'preset' => 'full'
		]) ?>

		<?= $form->field($model, 'bonus_text_ru')->widget(CKEditor::className(), [
			'options' => ['rows' => 4],
			'preset' => 'full'
		]) ?>

	    <?= $form->field($model, 'about_us_text_front_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

	    <?= $form->field($model, 'about_us_text_front_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

	    <?= $form->field($model, 'contacts_phone')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_cell_phone')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_cell_phone_2')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_cell_phone_3')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_cell_phone_4')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_email')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_skype')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_address')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'contacts_address_uk')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'front_video_url')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'google_play_link')->textInput(['maxlength' => true]) ?>
	    <?= $form->field($model, 'app_store_link')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'map_url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'yt_link')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'gp_link')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'fb_link')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'ok_link')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka1')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka1_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka2')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka2_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka3')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka3_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka4')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka4_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka5')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka5_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka6')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dostavka6_uk')->textInput(['maxlength' => true]) ?>
        

	    <?= $form->field($model, 'credits_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

	    <?= $form->field($model, 'credits')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

        
	    <div class="form-group">
	        <?= Html::submitButton('Редагувати', ['class' => 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
