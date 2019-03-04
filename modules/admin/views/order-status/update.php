<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatus */

$this->title = 'Редагувати статус: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Статуси замовлень', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="order-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
