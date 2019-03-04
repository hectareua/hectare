<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поля';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати поле', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Варіанти', ['field-option/index'], ['class' => 'btn']) ?>
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
