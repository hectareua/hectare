<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ClientTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доступи користувача';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати доступ користувача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_uk',
            'order',
            'stock',
            'arch_order',
            // 'depart_eval',
            // 'vote',
            // 'period_vote',
            // 'worker',
            // 'stock_with_filter',
            // 'rating',
            // 'shop',
            // 'bonus',
            // 'stock_in_cart',
            // 'partner_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
