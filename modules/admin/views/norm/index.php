<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Норми витрат';
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
         
            ['attribute'=>'plant_id','label'=>'Рослини', 'value'=>function($data) {
                    return $data->plants[0]['name_uk'];
                }],
            ['attribute'=>'product_id','label'=>'Засоби', 'value'=>function($data) {
                    return $data->product[0]['name_uk'];
               }],                          
           'norma',                   
      //      'product_id',           
      //      'product_name',           
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}{delete}',],
        ],
    ]); ?>
</div>
