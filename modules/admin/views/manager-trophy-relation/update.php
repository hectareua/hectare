<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophyRelation */

$this->title = 'Редагувати: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Призначити нагороду', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="manager-trophy-relation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'manager' => $manager,
        'trophy' => $trophy
    ]) ?>

</div>
