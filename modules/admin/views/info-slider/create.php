<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfoSlider */

$this->title = 'Додати Інфо слайд';
$this->params['breadcrumbs'][] = ['label' => 'Інфо слайди', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-slider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
