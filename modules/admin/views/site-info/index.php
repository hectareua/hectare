<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = 'Інформація сайту';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => array_keys($model->attributes),
    ]) ?>

</div>
