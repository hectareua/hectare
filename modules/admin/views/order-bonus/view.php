<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderBonus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонусні замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-bonus-view">

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
            ['attribute'=>'user_id',
                'value'=>function($model){
                    return $model->user->client->billing_last_name.' '.$model->user->client->billing_first_name;
                }],
            'productBonus.name_uk',
            'price',
            'ordered_at',
        ],
    ]) ?>

</div>
