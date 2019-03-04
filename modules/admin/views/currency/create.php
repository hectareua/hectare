<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\currency */

$this->title = 'Додати валюту';
$this->params['breadcrumbs'][] = ['label' => 'Валюти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
