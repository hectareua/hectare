<?php

use yii\helpers\Html;


$this->title = 'Створити лінки';
$this->params['breadcrumbs'][] = ['label' => 'Помощник', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'product' => $product,
		'phases' => $phases,
		'problems' => $problems,
		'plants' => $plants,         
		'sector_id' => array('0'=>'Промисловий','1'=>'Приватний'),         
    ]) ?>

</div>


