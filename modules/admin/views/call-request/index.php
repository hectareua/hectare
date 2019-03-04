<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CallRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення на дзвінок';
$this->params['breadcrumbs'][] = ['label' => 'Форми', 'url' => ['forms/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'user_name', 'value'=>'user.login'],
            'name',
            'phone',
            'requested_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>
</div>
