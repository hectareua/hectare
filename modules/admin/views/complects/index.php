<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Комплекти';
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
        <?= Html::a('Створити лінки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="country-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}{delete}',],
        ],
    ]); ?>
</div>
