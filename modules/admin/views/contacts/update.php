<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = 'Обновить контакт: ' . $model->c_id;
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c_id, 'url' => ['view', 'id' => $model->c_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
