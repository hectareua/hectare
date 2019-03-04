<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductPricesEnquiry */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Форми', 'url' => ['forms/index']];
$this->params['breadcrumbs'][] = ['label' => 'Питання про партнерьскі ціни', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a href="mailto:<?= $model->email.'?subject='.$model->product->name_uk?>" class="btn btn-primary">Відповісти</a>
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
            // 'id',
            'product.name_uk',
            // 'user_id',
            'name',
            'email:email',
            'phone',
            'asked_at',
        ],
    ]) ?>

</div>
