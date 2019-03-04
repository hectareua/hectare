<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Representative */

$this->title = 'Create Representative';
$this->params['breadcrumbs'][] = ['label' => 'Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="representative-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
