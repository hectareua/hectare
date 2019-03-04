<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = 'Додати партнера';
$this->params['breadcrumbs'][] = ['label' => 'Партнери', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
