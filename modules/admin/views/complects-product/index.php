<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Product;

$this->title = 'Товары в комплекте';
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
         
            ['attribute'=>'complectid','label'=>'Complect', 'value'=>function($data) {
                    return $data->complect->id .' ' . $data->complect->name;
                }],
             ['attribute'=>'productid','label'=>'Засоби', 'value'=>function($data) {
                    return $data->product->name;
               }],
           'attributeid',                   
      //     'complectid',                   
           'discount',                   
     //       'productid',           
      //      'product_name',           
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}{delete}',],
        ],
    ]); ?>
</div>
