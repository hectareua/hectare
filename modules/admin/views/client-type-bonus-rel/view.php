<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonusRel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бонус закріплений за менеджером', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-bonus-rel-view">

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
            'ctypeBonus.name_bonus_uk',
            'user.client.BillingFullName',
            'confirm',
            'show_ones',
            'created_at',
        ],
    ]) ?>

</div>
