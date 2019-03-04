<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SalePlan */

$this->title = 'Додати план';
$this->params['breadcrumbs'][] = ['label' => 'План продаж', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
