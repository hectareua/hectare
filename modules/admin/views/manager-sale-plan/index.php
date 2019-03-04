<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ManagerSalePlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Плани для менеджерів';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-sale-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати план для менеджера', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'manager.name',
            'sum_plan',
            'plan_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
