<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['label' => 'Ім\'я користувача', 'attribute' => 'client.billing_first_name'],
            'paymentSystem.name_uk',
            ['label' => 'Статус', 'attribute' => 'status.name_uk'],
            'ordered_at',
            'billing_fullname',
            'billing_city',
            'billing_region',
            'billing_phone',
            'billing_email:email',
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
    <?php if($products):?>
    <?php foreach($products as $product): ?>
        <div class="block_suggested_main" value="<?= $product->id ?>">
            <div class="block_suggested_name"><?= $product->name_uk ?></div>
            <div class="block_suggested_image">
                    <img src="<?= $product->getImages()->one()->url?>" class="suggested_image">
            </div>
            <?php foreach($model->orderProducts as $order_product):?>
                <?php if($order_product->product_id == $product->id):?>
                    <?= 'Кількість(шт.): '.$order_product->amount?>
                <?php endif?>
            <?php endforeach?>
        </div>
    <?php endforeach?>
    <?php endif?>

</div>
