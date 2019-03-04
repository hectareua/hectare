<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\History */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Гектар INFO', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Дадати ще', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити даний випуск?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'infoTabs.name_uk',
            'number',
            'header_uk',
            'header_ru',
            'author_uk',
            'author_ru',
            'desc_uk',
            'desc_ru',
            'image.url:image',
        ],
    ]) ?>

</div>
