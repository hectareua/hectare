<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Forum */

$this->title = 'Редагувати форум: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Форуми', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="forum-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
