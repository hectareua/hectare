<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\FilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фільтри для товарів';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити фільтр', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'filters', 'value'=>'filter.name_uk'],
            //'id',
            //'filter_id',
            'name_uk',
            'name_ru',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
