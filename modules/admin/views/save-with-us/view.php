<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SaveWithUs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Економте з нами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="save-with-us-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'name_uk',
            'name_ru',
            'image_id',
            'text_uk:ntext',
            'text_ru:ntext',
        ],
    ]) ?>

</div>
