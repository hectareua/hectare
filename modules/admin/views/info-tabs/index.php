<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\InfoTabsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категорія';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-tabs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати категорію', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_uk',
            'name_ru',
            'slug',
            [
                'attribute' => 'image.url',
                'format' => ['image', ['width' => '90px']],
                'contentOptions'=>['style'=>'max-width: 100px;']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
