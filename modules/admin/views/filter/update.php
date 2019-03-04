<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Filter */

$this->title = 'Редагувати фільтр: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Фільтри', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="filter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
