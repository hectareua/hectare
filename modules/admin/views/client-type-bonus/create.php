<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonus */

$this->title = 'Додати бонус';
$this->params['breadcrumbs'][] = ['label' => 'Бонус', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-bonus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
