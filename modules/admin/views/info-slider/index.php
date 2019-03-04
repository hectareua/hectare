<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\InfoSliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Інфо слайди';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-slider-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати слайд', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'link_uk',
            'title_uk',
            'desc_uk',
            [
                'attribute' => 'image.url',
                'label' => 'Картинка',
                'format' => ['image', ['width' => '90px']],
                'contentOptions'=>['style'=>'max-width: 100px;']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
