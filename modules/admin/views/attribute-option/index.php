<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Варіанти';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибути', 'url' => ['attribute/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-option-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати варіант', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'attr.name_uk', 'label' => 'Атрибут'],
            'name_uk',
            'name_ru',
            'multiplier',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
