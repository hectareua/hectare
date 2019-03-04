<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати продукт', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Атрибути', ['attribute/index'], ['class' => 'btn']) ?>
        <?= Html::a('Поля', ['field/index'], ['class' => 'btn']) ?>
        <?= Html::a('Фільтри', ['filter/index'], ['class' => 'btn']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'order',
            ['attribute'=>'category_id', 'value'=>'category.name_uk'],
            ['attribute'=>'manufacturer_id', 'value'=>'manufacturer.name'],
            'name_uk',
            'name_ru',
            // 'description_uk:ntext',
            // 'description_ru:ntext',
            // 'currency_id',
            // 'price',
            // 'old_price',
            // 'is_in_stock',
            // 'is_new',
            // 'is_on_sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
