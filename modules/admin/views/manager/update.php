<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Manager */

$this->title = 'Редагувати менеджера: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'менеджери', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="manager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'headOfManager' => $headOfManager,
    ]) ?>

</div>
