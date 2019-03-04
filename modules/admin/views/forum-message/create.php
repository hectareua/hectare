<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ForumMessage */

$this->title = 'Написати повідомлення';
$this->params['breadcrumbs'][] = ['label' => 'Повідомлення форуму', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
