<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderBonus */

$this->title = 'Редагувати бонусне замовлення: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонусні замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="order-bonus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'product' => $product
    ]) ?>

</div>
