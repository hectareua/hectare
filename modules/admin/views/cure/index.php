<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Помощник';
$this->params['breadcrumbs'][] = $this->title;
?>
    <p>
        <?= Html::a('Створити лінки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="country-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
  //  var_dump($searchModel);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
   //     'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
       //     'plant_id',
       //     'phase_id',           
            ['attribute'=>'plant_id','label'=>'Рослини', 'value'=>function($data) {
                    return $data->plants[0]['name_uk'];
                }],         
            ['attribute'=>'phase_id','label'=>'Фази', 'value'=> function($data) {
                    return $data->phases[0]['name_uk'];
                }],         
            ['attribute'=>'problem_id','label'=>'Проблеми', 'value'=>function($data) {
                    return $data->problems[0]['name_uk'];
                }],         
       //     ['attribute'=>'product_id','label'=>'Засоби', 'value'=>function($data) {
       //             return $data->product[0]['name_uk'];
       //         }],                       
            ['attribute'=>'sector_id','label'=>'Засоби', 'value'=>function($data) {
                    return ($data->sector_id==0)?'Промисловий':'Приватний';
                }],                       
      //     'problem_id',                   
      //      'product_id',           
      //      'product_name',           
            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}{delete}',],
        ],
    ]); ?>
</div>
