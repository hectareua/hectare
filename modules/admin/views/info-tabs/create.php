<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfoTabs */

$this->title = 'Додати категорію';
$this->params['breadcrumbs'][] = ['label' => 'Категорія', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-tabs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
