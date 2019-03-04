<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderBonus */

$this->title = 'Додати бонусне замовлення';
$this->params['breadcrumbs'][] = ['label' => 'Бонусне замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-bonus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'product' => $product
    ]) ?>

</div>
