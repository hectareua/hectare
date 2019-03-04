<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalePlan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'План продаж', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'plan_sum',
            [
                'attribute' => 'plan_year',
                'value' => function($data){
                    return $data->plan_year?'Так':'Ні';
                }
            ],
            'plan_date',
        ],
    ]) ?>

</div>
