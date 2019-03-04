<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонус', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-bonus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_bonus_uk',
            'condition_uk',
            'show_condition',
            'clientType.name_uk',
            'manufacturer.name',
            'attributeValue.product.name_uk',
            'bonus_one',
            'bonus_all',
            'qty_sale',
            'stage',
            'percent_stage',
            'money_plan',
            'date_from',
            'date_to',
        ],
    ]) ?>

</div>
