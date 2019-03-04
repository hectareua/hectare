<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientType */

$this->title = 'Редагувати доступи користувачів: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Доступи користувача', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="client-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
