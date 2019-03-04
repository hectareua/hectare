<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Problems */

$this->title = 'Створити проблему';
$this->params['breadcrumbs'][] = ['label' => 'Проблеми', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
