<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductBonus */

$this->title = 'Додати бонусний товар';
$this->params['breadcrumbs'][] = ['label' => 'Бонусний товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-bonus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
