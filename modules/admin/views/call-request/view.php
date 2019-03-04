<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CallRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Форми', 'url' => ['forms/index']];
$this->params['breadcrumbs'][] = ['label' => 'Замовлення на дзвінок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'user.login',
            'name',
            'phone',
            'requested_at',
        ],
    ]) ?>

</div>
