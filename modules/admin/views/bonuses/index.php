<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bonuse */

$this->title = 'Сторінка Бонуси';
$this->params['breadcrumbs'][] = ['label' => 'Бонуси', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $data->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $data,
        'attributes' => [
            'id',
            'one_title_ru',
            'one_title_uk',
            'one_content_ru',
            'one_content_uk',
            'mob_text_title_ru',
            'mob_text_title_uk',
            'mob_text_ru',
            'mob_text_uk',
            'two_title_ru',
            'two_title_uk',
            'two_content_ru',
            'two_content_uk',
            'three_title_ru',
            'three_title_uk',
            'three_content_ru',
            'three_content_uk',
            'four_content_ru',
            'four_content_uk'
        ],
    ]) ?>

</div>
