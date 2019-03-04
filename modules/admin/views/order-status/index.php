<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статуси замовлень';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Order Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name_uk',
            'name_ru',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}',],
        ],
    ]); ?>
</div>
