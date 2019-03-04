<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->dropdownList($statuses) ?>
    
    <?= $form->field($model, 'delivery_type')->dropdownList(\app\models\Order::$deliveryTypes) ?>

    <?= $form->field($model, 'ttn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="order-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'client_id',
            'paymentSystem.name_uk',
            'status.name_uk',
            'representative.address_uk',
            'ordered_at',
            'billing_fullname',
            'billing_city',
            'billing_region',
            'billing_phone',
            'billing_email:email',
            [
                'attribute'=>'delivery_type',
                'value'=>$model->getTypeOfDelivery()
            ],
            'delivery_fullname',
            'delivery_address',
            'delivery_city',
            'delivery_region',
            'delivery_country_id',
            'delivery_phone',
            'comment:ntext',
            'price',
            'bonus_write_off_request',
            'bonus_write_off',  
            'bonus_got',
        ],
    ]) ?>
</div>
