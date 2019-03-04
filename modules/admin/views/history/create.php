<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\History */

$this->title = 'Додати сторінку';
$this->params['breadcrumbs'][] = ['label' => 'Історія', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
