<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderBonusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бонусні замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-bonus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити замовлення', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'user_id',
             'value'=>function($model){
                return $model->user->client->billing_last_name.' '.$model->user->client->billing_first_name;
            }],
            ['attribute'=>'product_bonus_id', 'value'=>'productBonus.name_uk'],
            'price',
            'ordered_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
