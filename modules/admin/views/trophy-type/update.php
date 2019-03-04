<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrophyType */

$this->title = 'Редагувати тип нагороди: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Тип нагороди', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="trophy-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
