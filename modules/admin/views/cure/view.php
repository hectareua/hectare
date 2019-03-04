<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\country */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Помощник', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
       //     'plant_id',
      //      'plants.name',
       //     'phases.name',
       //     'problems.name',
      //      ['attribute'=>'product_id','label'=>'Продукт', 'value'=>$product[$model->product_id]], 
            ['attribute'=>'phase_id','label'=>'Фаза', 'value'=>$phases[$model->phase_id]], 
            ['attribute'=>'problem_id','label'=>'Проблема', 'value'=>$problems[$model->problem_id]], 
            ['attribute'=>'plant_id','label'=>'Рослина', 'value'=>$plants[$model->plant_id]], 
            ['attribute'=>'sector_id','label'=>'Сектор', 'value'=> (($model->sector_id==1)?'Приватний':'Промисловий')],  
     //       'phase_id',
     //       'problem_id',
            'product_id',
        ],
    ]) ?>

</div>
