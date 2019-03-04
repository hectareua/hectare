<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\manufacturer */

$this->title = 'Додати виробника';
$this->params['breadcrumbs'][] = ['label' => 'Виробники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
    ]) ?>

</div>
