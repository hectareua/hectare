<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Representatives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="representative-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Representative', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'region',
            'address',
            'address_uk',
            'region_ru',
            'region_uk',
            'phones:ntext',
            'email:email',
            'schedule',
            'longitude',
            'latitude',
            // 'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
