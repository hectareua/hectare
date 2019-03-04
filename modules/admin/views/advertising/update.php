<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Advertising */

$this->title = 'Реданувати рекламу: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Реклама', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="advertising-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
