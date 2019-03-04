<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cooperation */

$this->title = 'Редагування сторінки Співпраця з нами';
$this->params['breadcrumbs'][] = ['label' => 'Співпраця з нами', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="slide-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
