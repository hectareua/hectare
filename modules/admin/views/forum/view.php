<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $model app\models\Forum */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Форум', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-view">

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
            'category_id',
            'created_at',
            'user_id',
            'views',
            'text:ntext',
            'seo_title_uk',
            'seo_title_ru',
            'seo_keywords_uk',
            'seo_keywords_ru',
            'seo_description_uk:ntext',
            'seo_description_ru:ntext',
            'slug',
            'image.url:image',
        ],
    ]) ?>

    <?php echo ListView::widget([
    'dataProvider' => $messagesDataProvider,
    'itemView' => 'messages',
    'summary'=>'',
]); ?>


</div>
