<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Problems */

$this->title = 'Редагувати проблему: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Проблеми', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
