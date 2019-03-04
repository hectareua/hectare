<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Редагувати замовлення: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $model->is_one_c_order ? "<h2><font color='red'>Замовлення завантажене з 1С </font></h2><h2>1C ID:$model->one_c_order_id</h2>":''?>

    <?= $this->render('_form', [
        'model' => $model,
        'statuses' => $statuses,
    ]) ?>

</div>
