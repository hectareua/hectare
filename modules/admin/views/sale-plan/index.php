<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SalePlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'План продаж';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати план', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'plan_sum',
            'plan_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
