<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\country */

$this->title = 'Редагувати лінки: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complect product', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="country-update">

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
