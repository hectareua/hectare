<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

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
            // 'id',
            'publishing_since',
            'publishing_till',
            'title_uk',
            'title_ru',
            'text_uk:ntext',
            'text_ru:ntext',
            'seo_title_uk',
            'seo_title_ru',
            'seo_keywords_uk',
            'seo_keywords_ru',
            'seo_description_uk:ntext',
            'seo_description_ru:ntext',
            'slug',
            // 'image_id',
        ],
    ]) ?>

</div>
