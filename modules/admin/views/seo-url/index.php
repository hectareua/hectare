<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SeoUrlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seo Urls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-url-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Seo Url', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'title:ntext',
            'h1:ntext',
            // 'keywords:ntext',
            // 'description:ntext',
            // 'text:ntext',
            [
                'attribute' => 'status',
                'content' => function($data) {
                    return (int) $data->status ? 'Активна' : 'Не активна';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
