<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Додати продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'manufacturers' => $manufacturers,
        'currencies' => $currencies,
        'attributeOptions' => $attributeOptions,
        'fieldOptions' => $fieldOptions,
        'measuresList'=> $measuresList,
        'measuresListOptions' => $measuresListOptions,
        'measure' => $measure
    ]) ?>

</div>
