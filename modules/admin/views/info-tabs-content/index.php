<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Гектар INFO';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати випуск', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Категории', ['info-tabs/index'], ['class' => 'btn btn-default']) ?>
		<?= Html::a('Слайди', ['info-slider/index'], ['class' => 'btn btn-default']) ?>
		<?= Html::a('Реклама', ['advertising/index'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'infoTabs.name_uk',
            'number',
            'header_uk',
            'author_uk',
            'desc_uk',
            [
                    'attribute' => 'image.url',
                    'format' => ['image', ['width' => '90px']],
                    'contentOptions'=>['style'=>'max-width: 100px;']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderImg,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'image.url',
                'format' => ['image', ['width' => '90px']],
                'contentOptions'=>['style'=>'max-width: 100px;']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
