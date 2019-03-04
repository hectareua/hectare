<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ForumMessage */

$this->title = 'Редагувати повідомлення: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Повідомлення форуму', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="forum-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
