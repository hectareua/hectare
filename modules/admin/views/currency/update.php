<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\currency */

$this->title = 'Редагувати валюту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Валюти', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
