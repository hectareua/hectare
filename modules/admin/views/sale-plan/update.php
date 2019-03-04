<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalePlan */

$this->title = 'Редагувати план: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'План продаж', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="sale-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
