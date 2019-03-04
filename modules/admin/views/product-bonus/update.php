<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductBonus */

$this->title = 'Редагувати бонусний товар: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонусний товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="product-bonus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
