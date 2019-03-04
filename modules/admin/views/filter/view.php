<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Filter */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Фільтри', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filter-view">

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
            'filter.name_uk',
            'name_uk',
            'name_ru',
            'description_uk:ntext',
            'description_ru:ntext',
            'seo_title_uk',
            'seo_title_ru',
            'seo_keywords_uk',
            'seo_keywords_ru',
            'seo_description_uk:ntext',
            'seo_description_ru:ntext',
            'seo_header_uk',
            'seo_header_ru',
        ],
    ]) ?>

</div>
