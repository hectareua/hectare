<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductBonus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонусний товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-bonus-view">

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
            'image_id',
            'name_uk',
            'name_ru',
            'desc_uk',
            'desc_ru',
            'price',
        ],
    ]) ?>

</div>
