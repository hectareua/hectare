<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonus */

$this->title = 'Редагувати бонус: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонус', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="client-type-bonus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrAttributes' => $arrAttributes
    ]) ?>

</div>
