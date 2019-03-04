<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manager */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Менеджери', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-view">

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
            // 'id',
            'name',
            'phone',
            'job',
            'bd',
            'date_add',
            [
                'attribute' => 'manager_type',
                'format' => 'raw',
                'value' => function($data){
                    switch ($data->manager_type){
                        case 1:
                            return 'Робітник централього офісу';
                            break;
                        case 2:
                            return 'Менеджер магазину';
                            break;
                        case 3:
                            return 'Робітник магазину';
                            break;
                    }
                }
            ],
            [
                'attribute' => 'manager_add_id',
                'value' => $headOfManager,


            ],
            'carma',
            'email',
            'image.url',
        ],
    ]) ?>

</div>
