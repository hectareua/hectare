<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonusRel */

$this->title = 'Редагувати бонус закріплений за менеджером: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонус закріплений за менеджером', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="client-type-bonus-rel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
