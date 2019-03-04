<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Slide */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            ['attribute' => 'id', 'label' => 'Ідентифікатор&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'],
            
            'description_uk:ntext',
            'link_uk',
            ['attribute' => 'imageuk.url', 'label' => 'Зображення для українського сайту', 'format' => 'image'],
            'description_ru:ntext',
            'link_ru',
            ['attribute' => 'imageru.url', 'label' => 'Зображення для російського сайту', 'format' => 'image'],
        ],
    ]) ?>

</div>
