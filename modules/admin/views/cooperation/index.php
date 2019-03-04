<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cooperation */

$this->title = 'Сторінка Співпраця з нами';
$this->params['breadcrumbs'][] = ['label' => 'Співпраця з нами', 'url' => ['index']];
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
            'text_uk',
            'text_ru',
        ],
    ]) ?>

</div>
