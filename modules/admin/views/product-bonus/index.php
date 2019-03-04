<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductBonusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бонусний товар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-bonus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати бонусний товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'image_id',
            'name_uk',
            'name_ru',
            'desc_uk',
            // 'desc_ru',
             'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
