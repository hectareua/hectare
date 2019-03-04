<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ManagerSalePlan */

$this->title = 'Додати план на менеджера';
$this->params['breadcrumbs'][] = ['label' => 'Плани для менеджерів', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-sale-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
