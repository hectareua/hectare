<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Редагувати продукт: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'complects' => $complects,
        'categories' => $categories,
        'filters' => $filters,      
        'manufacturers' => $manufacturers,
        'currencies' => $currencies,
        'attributeOptions' => $attributeOptions,
        'fieldOptions' => $fieldOptions,
        'measuresList'=> $measuresList,
        'measuresListOptions' => $measuresListOptions,
        'measure' => $measure
    ]) ?>

</div>
