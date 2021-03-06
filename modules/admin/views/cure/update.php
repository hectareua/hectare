<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\country */

$this->title = 'Редагувати лінки: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Помощник', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="country-update">

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
