<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophyRelation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Призначити нагороду', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-trophy-relation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити запис?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'manager.name',
            'managerTrophy.desc_uk',
        ],
    ]) ?>

</div>
