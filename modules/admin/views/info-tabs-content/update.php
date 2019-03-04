<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\History */

$this->title = 'Редагувати випуск: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Гектар INFO', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="slide-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'infoTabs' => $infoTabs,
    ]) ?>

</div>
