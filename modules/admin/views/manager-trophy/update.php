<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophy */

$this->title = 'Редагувати нагороду: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Нагороди менеджерів', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="manager-trophy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'trophyType' => $trophyType,
    ]) ?>

</div>
