<?php

use yii\helpers\Html;


$this->title = 'Створити лінки';
$this->params['breadcrumbs'][] = ['label' => 'Complect product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'product' => $product,
		'attributeValue' => $attributeValue,
		'complect' => $complect,
		'productid' => $productid,
		'attributeid' => $attributeid,
		'complectid' => $complectid,  
    ]) ?>

</div>


