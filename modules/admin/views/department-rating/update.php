<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentRating */

$this->title = 'Редагувати голос: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Рейтинг голосування', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="department-rating-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
