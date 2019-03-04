<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FieldOption */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => 'Поля', 'url' => ['field/index']];
$this->params['breadcrumbs'][] = ['label' => 'Варіанти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-option-view">

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
            ['attribute' => 'field.name_uk', 'label' => 'Поле'],
            'name_uk',
            'name_ru',
        ],
    ]) ?>

</div>
