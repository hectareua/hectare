<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Варіанти';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => 'Поля', 'url' => ['field/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-option-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати варіант', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'field.name_uk', 'label' => 'Поле'],
            'name_uk',
            'name_ru',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
