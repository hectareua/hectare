<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use app\models\ClientType;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin( [
        'options' => [
            'novalidate' => true
        ]
    ]); ?>

    <?php
        Modal::begin([
                'header'=>'<div><h4>Інформація платника</h4></div>',
                'id'=>'modalClient',
                'size'=>'modal-lg',
            ]);
    ?>
        <div id='modalClientContent'>
            <?= $form->field($client, 'billing_first_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'billing_last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'billing_middle_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'billing_address')->textarea(['rows' => 6]) ?>

            <?= $form->field($client, 'billing_city')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'billing_postcode')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'billing_region')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'billing_country_id')->dropdownList($client->countries) ?>


            <div class="form-group">
                <?= Html::button($client->isNewRecord ? 'Додати' : 'Редагувати', ['class' => 'billing_form_save ' . ($client->isNewRecord ? 'btn btn-success' : 'btn btn-primary')]) ?>
            </div>
        </div>
    <?php
        Modal::end();
    ?>
    <?php
        Modal::begin([
                'header'=>'<div><h4>Інформація доставки</h4></div>',
                'id'=>'modalDelivery',
                'size'=>'modal-lg',
            ]);
    ?>
        <div id='modalDeliveryContent'>
            <?= $form->field($client, 'delivery_first_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'delivery_last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'delivery_middle_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'delivery_address')->textarea(['rows' => 6]) ?>

            <?= $form->field($client, 'delivery_city')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'delivery_postcode')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'delivery_region')->textInput(['maxlength' => true]) ?>

            <?= $form->field($client, 'delivery_country_id')->dropdownList($client->countries) ?>

            <?= $form->field($client, 'delivery_phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->error(false)->input('tel', [ 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required'=>'']) ?>

            <div class="form-group">
                <?= Html::button($client->isNewRecord ? 'Додати' : 'Редагувати', ['class' => 'delivery_form_save ' . ($client->isNewRecord ? 'btn btn-success' : 'btn btn-primary')]) ?>
            </div>
        </div>
    <?php
        Modal::end();
    ?>

    <?= $form->field($client, 'billing_phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->error(false)->input('tel', [ 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required'=>'']) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager_id')->dropdownList($managers) ?>

    <?= $form->field($model, 'is_admin')->checkBox() ?>

    <?= $form->field($model, 'is_active')->checkBox() ?>
    
    <?= $form->field($model, 'ctype')->dropdownList(ArrayHelper::map(ClientType::find()->all(),'id','name_uk')) ?>  
      
    <?= $form->field($model, 'ctypeid')->dropdownList( ArrayHelper::map(app\models\Manufacturer::find()->all(), 'id', 'name')) ?> 

    <div class="form-group">
        <p> <?= Html::Button('Клієнтська інформація', ['class' => 'btn btn-primary', 'id'=>'modalButtonBilling']) ?>
            <?= Html::Button('Інформація доставки', ['class' => 'btn btn-primary', 'id'=>'modalButtonDelivery']) ?></p>

        <p><?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?></p>
    </div>

    <?php ActiveForm::end(); ?>

</div>
