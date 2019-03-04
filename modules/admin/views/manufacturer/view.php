<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\manufacturer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Виробники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-view">

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
            'name',
            'slug',
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
            'country_id',
			'code1c',
        ],
    ]) ?>

</div>
