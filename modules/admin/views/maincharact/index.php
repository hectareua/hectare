<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Основні характеристики';
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
        <?= Html::a('Створити лінки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="country-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,   
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'product_id','label'=>'Засоби', 'value'=>function($data) {
                    return $data->product[0]['name_uk'];
               }],                          
           'name_ru',                   
           'name_uk',                   
           'val',         
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}{delete}',],
        ],
    ]); ?>
</div>
