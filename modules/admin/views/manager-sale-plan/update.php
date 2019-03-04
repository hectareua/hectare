<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerSalePlan */

$this->title = 'Редагувати план для менеджера: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Плани для менеджерів', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manager-sale-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
