<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientType */

$this->title = 'Доступи користувача';
$this->params['breadcrumbs'][] = ['label' => 'Доступи користувача', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
