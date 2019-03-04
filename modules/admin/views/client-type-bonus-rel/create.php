<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonusRel */

$this->title = 'Create Client Type Bonus Rel';
$this->params['breadcrumbs'][] = ['label' => 'Client Type Bonus Rels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-bonus-rel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
