<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SlideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slides';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Slide', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description_uk:ntext',
            'description_ru:ntext',
            'link_ru',
            'link_uk',
            'image_id_ru',
            'image_id_uk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
