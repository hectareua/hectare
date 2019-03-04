<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InfoTabs */

$this->title = 'Редагувати категорію: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Категорія', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="info-tabs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
