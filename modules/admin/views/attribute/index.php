<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Атрибути';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати атрибут', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Варіанти', ['attribute-option/index'], ['class' => 'btn']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_uk',
            'name_ru',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
